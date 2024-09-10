<?php

    use Leaf\Flash;
    use PHPMailer\PHPMailer\PHPMailer;

    class UserActionsController extends BaseModel {

        public function __construct(protected $disciplinesModel, protected $usersModel, protected $gradesModel, protected $techniquesModel){
            parent::__construct();
            $this->phpMailer = new PHPMailer();
        }

        public $student = null;

        public $schedules = null;

        public function registration(){
            return $this->checkInputsRegistration() ? ViewHandler::redirect('login') : ViewHandler::render('registration',disciplines:$this->disciplinesModel->getAllDisciplines(), ages:$this->usersModel->getAllAgesRanges(), grades:$this->gradesModel->getAll());
        }

        public function checkInputsRegistration() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                try {
                    if (!ReCaptcha::checkCaptcha()) {
                        throw new Exception("Problème de connexion..captcha");
                    }
                    // Vérification que tous les champs requis sont présents et non vides
                    if (empty($_POST['name']) || empty($_POST['firstname']) || empty($_POST['email']) ||
                        empty($_POST['password']) || empty($_POST['password-retyped']) || 
                        empty($_POST['birthdate']) || empty($_POST['discipline']) || empty($_POST['grade'])) {
                        throw new Exception("Tous les champs sont obligatoires.");
                    }

                    if (!TokenGenerator::checkCsrfToken($_POST['csrf_token'])) {
                        throw new Exception("Nous rencontrons un problème csrf.");
                    }
        
                    // Validation des données
                    Validator::registration($_POST);
                    if (Validator::$errors) {
                        throw new Exception("Des erreurs de validation ont été détectées.");
                    }
        
                    // Filtrage et validation des inputs
                    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
                    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS);
                    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
                    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
                    $passwordRetyped = filter_input(INPUT_POST, 'password-retyped', FILTER_SANITIZE_SPECIAL_CHARS);
                    $birthdate = filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_SPECIAL_CHARS);
                    $discipline = filter_input(INPUT_POST, 'discipline', FILTER_VALIDATE_INT);
                    $grade = filter_input(INPUT_POST, 'grade', FILTER_VALIDATE_INT);
        
                    // Validation supplémentaire pour le mot de passe et la date de naissance
                    if ($_POST['password'] !== $_POST['password-retyped']) {
                        Validator::$errors['password-retyped'] = "Les mots de passe ne correspondent pas !";
                        throw new Exception("Les mots de passe ne correspondent pas.");
                    }
        
                    $bd_fragment = explode('-', $birthdate);
                    if (!checkdate($bd_fragment[1], $bd_fragment[2], $bd_fragment[0])) {
                        throw new Exception("La date de naissance est invalide.");
                    }
        
                    if (!$name || !$firstname || !$email || !$password || !$birthdate || !$discipline || !$grade) {
                        throw new Exception("Une ou plusieurs données sont invalides.");
                    }
        
                    // Génération du token
                    $token = TokenGenerator::getRandomStringRandomInt();
        
                    // Insertion dans la base de données
                    if (!$this->usersModel->insertUser($name, $firstname, $birthdate, date('Y-m-d H:i:s'), $email, $password, date("Y-m-d H:i:s"), $discipline, $grade, $token)) {
                        Flash::set("Désolé, il semblerait que vous soyez déjà inscrit, vérifiez vos mails.", "registration_failed");
                        return false;
                    }
        
                    // Envoi de l'email d'activation
                    $this->sendEmailActivationAccount($name,$firstname,$token, $email);
                    Flash::set("Un email de validation vous a été envoyé, cliquez sur le lien pour activer le compte.", "registration_success");
                    return true;
        
                } catch (Exception $e) {
                    // Gestion des erreurs : enregistrement dans les logs et affichage d'un message d'erreur
                    error_log($e->getMessage());
                    Flash::set($e->getMessage(), "registration_failed");
                    return false;
                }
            }
        }
        
        public function validAccountMail(){
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                try {
                    if (empty($_GET['student_token'])) {
                        throw new Exception("Erreur un token doit être présent.");
                    }
                    if(!$this->usersModel->validStudentTokenMail($_GET['student_token'])){
                        throw new Exception("Le token n'est pas celui attendu.");
                    }
                    Flash::set('Votre compte à été validé.', 'valid_email_checking');
                    ViewHandler::redirect('login');
                } catch (Exception $err){
                    Flash::set($err->getMessage(), 'error_email_checking');
                    ViewHandler::render('home');
                }
            }
        }

        public function login(){
            if ($this->checkInputsLogin()) {
                $this->mySpace();
            }else{
                ViewHandler::redirect('login');
            }
        }

        public function checkInputsLogin(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                try {
                    if (!ReCaptcha::checkCaptcha()) {
                        throw new Exception("Problème de connexion..captcha");
                    }
                    if (empty($_POST['firstname']) || empty($_POST['email']) || empty($_POST['password'])) {
                        throw new Exception("Tout les champs doivent être remplis.");
                    }
                    if (!TokenGenerator::checkCsrfToken($_POST['csrf_token'])) {
                        throw new Exception("Nous rencontrons un problème csrf.");
                    }
                    Validator::login($_POST);
                    if (Validator::$errors) {
                        throw new Exception("Des erreurs ont été détectés lors de la connexion.");
                    }
                    if(!$this->usersModel->checkPasswordLogin($_POST['email'], $_POST['firstname'], $_POST['password'])){
                        Flash::set('Une erreur est survenue lors de la connexion.','user_connect_error');
                        return false;
                    }

                    $this->student = new stdClass();
                    
                    $this->student = $this->usersModel->getStudentByEmailFirstname($_POST['email'], $_POST['firstname']);
                    $this->student->nbTechniques = 0;
                    $this->student->validTechniques = 0;

                    // get student discipline via discipline_id in students table
                    $this->student->discipline = $this->disciplinesModel->getOne($this->student->discipline_id);
                    // get all techniques category by discipline_id of student and his grade 
                    $this->student->categories = $this->techniquesModel->getAllCategoriesByDiscipline($this->student->discipline_id, $this->student->grade_id);
                    foreach ($this->student->categories as $key_category => $category) {
                        $this->student->categories[$key_category]->techniques = $this->techniquesModel->getAllTechniquesByDisciplineGradeCategory($this->student->discipline_id, $this->student->categories[$key_category]->technique_category,$this->student->grade_id);
                        foreach($this->student->categories[$key_category]->techniques as $key_technique => $technique){
                            $this->student->nbTechniques += 1;
                            $this->student->categories[$key_category]->techniques[$key_technique]->valid = $this->techniquesModel->getAllTechniquesLearnedByStudentId($this->student->student_id, $technique->technique_name);
                            if($this->student->categories[$key_category]->techniques[$key_technique]->valid){
                                $this->student->validTechniques += 1;
                            }
                        }
                    }

                    $_SESSION['user_info'] = $this->student;

                    Flash::save('userLogged');
                    Flash::set('Vous êtes connecté, bienvenue !', 'user_connect_success');
                    return true;
                } catch (Exception $e){
                    Flash::set($e->getMessage(), 'user_connect_error');
                    ViewHandler::render('login');
                }  
            }else {
                ViewHandler::render('login');
            }
        }

        public function sendEmailPasswordChanging($student_email, $token){
            try {                
                $this->phpMailer->isSMTP();
                $this->phpMailer->Host = 'smtp.gmail.com';
                $this->phpMailer->Port = 465;
                $this->phpMailer->CharSet = "UTF-8";
                $this->phpMailer->SMTPAuth = true;
                $this->phpMailer->SMTPSecure = 'ssl';
                $this->phpMailer->Username = 'frdjacobbb@gmail.com';
                $this->phpMailer->Password = 'jvnw eepr qrzm bszn';
                $this->phpMailer->setFrom('frdjacobbb@gmail.com', 'BUDOSPORT-80-');
                $this->phpMailer->addAddress($student_email, 'Destinataire');
                $this->phpMailer->Subject = 'Mise à jour de votre mot de passe';
                $this->phpMailer->Body = "
                    <!DOCTYPE html>
                    <html>
                        <head>
                            <meta charset='UTF-8'>
                        </head>
                        <body>
                            <a href='https://budosport-80.alwaysdata.net/?q=change-password&student_token=$token'>Changer votre mot de passe en cliquant sur ce lien</a>
                        </body>
                    </html>
                ";
                $this->phpMailer->isHTML();
                if (!$this->phpMailer->send()) {
                    throw new Exception("Une erreur est survenue lors de l'envoi du mail.");
                }
                Flash::set("Vous allez recevoir un mail d'ici quelques minutes.", 'success_mail_send');
                return true;
            } catch (Exception $err) {
                Flash::set($err->getMessage(), "error_mail_send");
                return false;
            }
        }

        public function sendEmailActivationAccount($name,$firstname,$token,$email){
            $name = ucfirst($name);
            $firstname = ucfirst($firstname);
            try {                
                $this->phpMailer->isSMTP();
                $this->phpMailer->Host = 'smtp.gmail.com';
                $this->phpMailer->Port = 465;
                $this->phpMailer->CharSet = "UTF-8";
                $this->phpMailer->SMTPAuth = true;
                $this->phpMailer->SMTPSecure = 'ssl';
                $this->phpMailer->Username = 'frdjacobbb@gmail.com';
                $this->phpMailer->Password = 'jvnw eepr qrzm bszn';
                $this->phpMailer->setFrom('frdjacobbb@gmail.com', 'BUDOSPORT 80');
                $this->phpMailer->addAddress($email, 'Destinataire');
                $this->phpMailer->Subject = 'Valider l\'accès à votre compte !';
                $this->phpMailer->Body = "
                    <!DOCTYPE html>
                    <html>
                        <head>
                            <meta charset='UTF-8'>
                        </head>
                        <body>
                            <p>Bonjour $name - $firstname, clique sur ce lien pour valider ton compte.</p>
                            <a href='https://budosport-80.alwaysdata.net/?q=valid-account-mail&student_token=$token'>ACTIVER MON COMPTE</a>
                        </body>
                    </html>
                    ";
                $this->phpMailer->isHTML();
                if (!$this->phpMailer->send()) {
                    Flash::set("L'envoi de l'email à échoué, veuillez réessayer. Si le problème persiste, contactez nous.", "error_mail_send");
                    return false;
                }else{
                    return true;
                }
            } catch (\Throwable $th) {
                var_dump($th);die;
            }
        }

        public function passwordForgotten(){
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                try {
                    if (!ReCaptcha::checkCaptcha()) {
                        throw new Exception("Problème de connexion..captcha");
                    }
                    if (empty($_POST['name']) || empty($_POST['firstname']) || empty($_POST['email'])) {
                        throw new Exception("Veuillez remplir tout les champs.");
                    }
                    if (!TokenGenerator::checkCsrfToken($_POST['csrf_token'])) {
                        throw new Exception("Nous rencontrons un problème csrf.");
                    }
                    Validator::reset_password($_POST);
                    if(Validator::$errors){
                        throw new Exception("Des erreurs ont été levés.");
                    }
                    if(!$user_info = $this->usersModel->getStudentByEmailFirstnameLastname(email:$_POST['email'],lastname:$_POST['name'],firstname:$_POST['firstname'])){
                        throw new Exception("Nous rencontrons un problème avec vos identifiants, une ou plusieurs erreurs.");
                    }
                    if(!$this->sendEmailPasswordChanging($user_info['student_email'], $user_info['student_token'])){
                        throw new Exception('Une erreur est survenue lors de l\'envoi du mail de récupération.');
                    }
                    Flash::set("Vous allez recevoir le mail de réinisialisation de mot de passe d'ici quelques minutes.");
                    ViewHandler::redirect('login'); 
                } catch (Exception $e){
                    Flash::set($e->getMessage(), 'change_password_error');
                    ViewHandler::render('forgot-password');
                }
            }else{
                ViewHandler::render('forgot-password');
            }
        }

        public function changePassword(){
            if (!empty($_GET['student_token'])) {
                try {
                    if(!$this->usersModel->checkUserExistByToken($_GET['student_token'])){
                        throw new Exception("Une erreur est survenue, un problème d'identifiants.");
                    }
                    if (empty($_POST['password'])) {
                        ViewHandler::render('change-password');  
                        return false;                      
                    }
                    Validator::passwordChanging($_POST);
                    if (Validator::$errors) {
                        throw new Exception("Des erreurs ont été détectée, veuillez vérifier vos saisies.");
                    }
                    if(!$this->usersModel->changePassword($_POST['password'], $_GET['student_token'])){
                        throw new Exception("Le mot de passe n'a pas été modifié.");
                    }
                    Flash::set('Votre mot de passe à été changé avec succès.', 'change_password_success');
                    header("Location: ?q=login");
                    exit;
                } catch(Exception $e){
                    Flash::set($e->getMessage(), 'change_password_error');
                    ViewHandler::render('forgot-password');
                }
            }else{
                ViewHandler::redirect('login');
            }
        }

        public function listDisciplines(){
            ViewHandler::render('disciplines', disciplines:$this->disciplinesModel->getAllDisciplines());
        }

        public function mySpace(){
            if (isset($_SESSION['budosport']['userLogged'])) {
                ViewHandler::render('mon-espace');
            }else{
                ViewHandler::redirect('home');
            }
        }

        public function disconnect(){
            Flash::clearSaved();
            $_SESSION['user_info'] = 0;
            Flash::set("Vous êtes déconnecté.","user_disconnect");
            ViewHandler::redirect('home');
        }

    }
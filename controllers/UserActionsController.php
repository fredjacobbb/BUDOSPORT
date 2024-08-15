<?php

    use Leaf\Flash;
    use PHPMailer\PHPMailer\PHPMailer;

    class UserActionsController extends BaseModel {

        public function __construct(protected $disciplinesModel, protected $usersModel, protected $gradesModel){
            parent::__construct();
            $this->phpMailer = new PHPMailer();
        }

        public function registration(){
            return $this->checkInputsRegistration() ? ViewHandler::redirect('login') : ViewHandler::render('registration',disciplines:$this->disciplinesModel->getAllDisciplines(), ages:$this->usersModel->getAllAgesRanges(), grades:$this->gradesModel->getAll());
        }

        public function checkInputsRegistration(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!empty($_POST['name'] && !empty($_POST['firstname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password-retyped']) && !empty($_POST['birthdate'] && !empty($_POST['discipline']) && !empty($_POST['grade'])))) {
                    Validator::registration($_POST);
                    if (!Validator::$errors) {
                        $name = filter_var($_POST['name']);
                        $firstname = filter_var($_POST['firstname']);
                        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
                        $password = filter_var($_POST['password']);
                        $birthdate = filter_var($_POST['birthdate']);
                        $discipline = filter_var($_POST['discipline'], FILTER_VALIDATE_INT);
                        $grade = filter_var($_POST['grade'], FILTER_VALIDATE_INT);
                        $bd_fragment = explode('-',$birthdate);
                        $token = TokenGenerator::getRandomStringRandomInt();
                        if ($_POST['password'] === $_POST['password-retyped']) {
                            if(checkdate($bd_fragment[2],$bd_fragment[1],$bd_fragment[0]) && $name && $firstname && $email && $password && $birthdate && $discipline && $grade){
                                if(!$this->usersModel->insertUser($name,$firstname,$birthdate,date('Y-m-d H:m'),$email,$password,date("Y-m-d H:m"),$discipline,$grade,$token)){
                                    Flash::set("Désolé, il semblerait que vous soyez déja inscrit, vérifiez vos mails.", "registration_failed");
                                    return false;
                                }else{
                                    $this->sendEmailActivationAccount();
                                    Flash::set("Un email de validation vous a été envoyé, cliquez sur le lien pour activer le compte.", "registration_success");
                                    return true;
                                }
                            }else{
                                var_dump('psa date');die;
                            }
                        }else{
                            // a changer de place
                            Validator::$errors['password-retyped'] = "Les mots de passe ne correspondent pas !";
                        }
                    }
                }
            }
        }

        public function validAccountMail(){
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                if (!empty($_GET['token'])) {
                    if($this->usersModel->validStudentTokenMail($_GET['token'])){
                        Flash::set('Votre compte à été validé, l\'administrateur va accepter votre demande.', 'valid_email_checking');
                        ViewHandler::render('login');
                    }else{
                        ViewHandler::render('home');
                    }
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
                if (!empty($_POST['firstname']) && !empty($_POST['email']) && !empty($_POST['password'])) {
                    Validator::login($_POST);
                    if (!Validator::$errors) {
                        if(!$this->usersModel->checkPasswordLogin($_POST['email'], $_POST['firstname'], $_POST['password'])){
                            Flash::set('Une erreur est survenue lors de la connexion.','user_connect_error');
                            return false;
                        }else{
                            $_SESSION['user_info'] = $this->usersModel->getStudentByEmailFirstname($_POST['email'], $_POST['firstname']);
                            Flash::save('userLogged');
                            Flash::set('Vous êtes connecté, bienvenue !', 'user_connect_success');
                            return true;
                        }
                    }else{
                        ViewHandler::render('login');
                    }
                }else{
                    ViewHandler::render('login');
                }
            }else{
                ViewHandler::render('login');
            }
        }

        public function sendEmailPasswordChanging($student_email, $student_id, $student_token){
            try {                
                $this->phpMailer->isSMTP();
                $this->phpMailer->Host = 'smtp.gmail.com';
                $this->phpMailer->Port = 465;
                $this->phpMailer->SMTPAuth = true;
                $this->phpMailer->SMTPSecure = 'ssl';
                $this->phpMailer->Username = 'frdjacobbb@gmail.com';
                $this->phpMailer->Password = 'jvnw eepr qrzm bszn';
                $this->phpMailer->setFrom('frdjacobbb@gmail.com', 'BUDOSPORT-80-');
                $this->phpMailer->addAddress('merguez.on.my.back@gmail.com', 'Destinataire');
                $this->phpMailer->Subject = 'Mise à jour de votre mot de passe';
                $this->phpMailer->Body = '<a href="./?q=update-password&student_id=$student_id&token=$student_token">Changer votre mot de passe en cliquant sur ce lien</a>';
                if (!$this->phpMailer->send()) {
                    Flash::set("L'envoi de l'email à échoué, veuillez réessayer. Si le problème persiste, contactez nous.", "error_mail_send");
                    return false;
                }else{
                    Flash::set('Vous allez recevoir un mail d\'ici quelques minutes.', 'success_mail_send');
                    return true;
                }
            } catch (\Throwable $th) {
                var_dump($th);die;
            }
        }

        public function sendEmailActivationAccount(){
            try {                
                $this->phpMailer->isSMTP();
                $this->phpMailer->Host = 'smtp.gmail.com';
                $this->phpMailer->Port = 465;
                $this->phpMailer->SMTPAuth = true;
                $this->phpMailer->SMTPSecure = 'ssl';
                $this->phpMailer->Username = 'frdjacobbb@gmail.com';
                $this->phpMailer->Password = 'jvnw eepr qrzm bszn';
                $this->phpMailer->setFrom('frdjacobbb@gmail.com', 'BUDOSPORT-80-');
                $this->phpMailer->addAddress('merguez.on.my.back@gmail.com', 'Destinataire');
                $this->phpMailer->Subject = 'Valider l\'accès à votre compte !';
                $this->phpMailer->Body = '
                    <!DOCTYPE html>
                    <html>
                        <head>
                            <meta charset="UTF-8">
                        </head>
                        <body>
                            <p>Bonjour $pseudo, clique sur ce lien pour valider ton compte.</p>
                            <a href="./?q=active-account&student_id=$student_id&token=$student_token">ACTIVER MON COMPTE</a>
                        </body>
                    </html>
                    ';
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
                if (!empty($_POST['name']) && !empty($_POST['firstname']) && !empty($_POST['email'])) {
                    Validator::reset_password($_POST);
                    if(!Validator::$errors){
                        if($user_info = $this->usersModel->getStudentByEmailFirstnameLastname(email:$_POST['email'],lastname:$_POST['name'],firstname:$_POST['firstname'])){
                            $this->sendEmailPasswordChanging($user_info['student_email'], $user_info['student_id'], $user_info['student_token']) ? ViewHandler::redirect('login') : ViewHandler::render('forgot-password');
                        }else {
                            Flash::set('Nous rencontrons un problème avec vos identifiants, une ou plusieurs erreur.', 'change_password_error');
                            ViewHandler::render('forgot-password');
                        }
                    }else{
                        ViewHandler::render('forgot-password');
                    }
                }else{
                    Flash::set('Nous rencontrons un problème avec vos identifiants, une ou plusieurs erreur.', 'change_password_error');
                    ViewHandler::render('forgot-password');
                }
            }else{
                ViewHandler::render('forgot-password');
            }
        }

        public function changePassword(){
            if (!empty($_GET['token'])) {
                if(!$this->usersModel->checkUserExistByToken($_GET['token'])){
                    ViewHandler::render('home');
                }else{
                    if (!empty($_POST['password'])) {
                        Validator::passwordChanging($_POST);
                        if (!Validator::$errors) {
                            if($this->usersModel->changePassword($_POST['password'], $_GET['token'])){
                                Flash::set('Votre mot de passe à été changé avec succès.', 'change_password_success');
                                header("Location:./?q=login");
                                exit;
                            }else{
                                ViewHandler::render('change-password');
                            }
                        }else{
                            ViewHandler::render('change-password');
                        }
                    }else{
                        ViewHandler::render('change-password');
                    }
                }
            }else{
                ViewHandler::render('home');
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
            Flash::set("Vous êtes déconnecté.","user_disconnect");
            ViewHandler::redirect('home');
        }

    }
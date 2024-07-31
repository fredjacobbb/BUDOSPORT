<?php 

    use Leaf\Flash;
    use PHPMailer\PHPMailer\PHPMailer;

    class UserActionsController extends BaseModel {

        public function __construct(protected $disciplinesModel, protected $usersModel, protected $gradesModel){
            parent::__construct();
            $this->phpMailer = new PHPMailer();
        }

        public function registration(){
            return $this->checkInputsRegistration() ? ViewHandler::render('login') : ViewHandler::render('registration',disciplines:$this->disciplinesModel->getAll(), ages:$this->usersModel->getAllAgesRanges(), grades:$this->gradesModel->getAll());
        }

        public function checkInputsRegistration(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!empty($_POST['name'] && !empty($_POST['firstname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['birthdate'] && !empty($_POST['discipline']) && !empty($_POST['grade'])))) {
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
                        if(checkdate($bd_fragment[2],$bd_fragment[1],$bd_fragment[0]) && $name && $firstname && $email && $password && $birthdate && $discipline && $grade){
                            if(!$this->usersModel->insertUser($name,$firstname,$birthdate,date('Y-m-d H:m'),$email,$password,date("Y-m-d H:m"),$discipline,$grade,$token)){
                                Flash::set("Désolé, il semblerait que vous soyez déja inscrit, vérifiez vos mails.", "registration_failed");
                                return false;
                            }else{
                                $this->sendEmailActivationAccount();
                                Flash::set("Un email de validation vous a été envoyé, cliquez sur le lien pour activer le compte.", "registration_success");
                                return true;
                            }
                        }
                    }
                }
            }
        }

        public function login(){
            $this->checkInputsLogin();
            ViewHandler::render('login');
        }

        public function checkInputsLogin(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!empty($_POST['firstname']) && !empty($_POST['email']) && !empty($_POST['password'])) {
                    Validator::login($_POST);
                    if (!Validator::$errors) {
                        Flash::set('user_connected', 1);
                        Flash::set('user_connected_flash','Vous êtes connecté, bienvenue !');
                        ViewHandler::render('monespace');
                    }
                }
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
                            $this->sendEmailPasswordChanging($user_info['student_email'], $user_info['student_id'], $user_info['student_token']) ? ViewHandler::render('login') : ViewHandler::render('forgot-password');
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

        //Flash::set("Les informations saisies semblent incorrects.", "change_password_error")

    }
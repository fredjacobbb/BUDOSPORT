<?php 

    use Leaf\Flash;

    class UserActionsController extends BaseModel {

        public function __construct(protected $disciplinesModel, protected $usersModel, protected $gradesModel){
            parent::__construct();
        }

        public function registration(){
            return $this->checkInputsRegistration() ? ViewHandler::render('home') : ViewHandler::render('registration',disciplines:$this->disciplinesModel->getAll(), ages:$this->usersModel->getAllAgesRanges(), grades:$this->gradesModel->getAll());
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
                    Validator::registration($_POST);
                    if (!Validator::$errors) {
                        
                    }
                }
            }
        }

        public function passwordForgotten(){
            
        }

    }
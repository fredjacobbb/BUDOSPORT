<?php 

    class UserActionsController extends BaseModel {

        public function __construct(protected $disciplinesModel, protected $usersModel, protected $gradesModel){
            
        }

        public function registration(){
            $this->checkInputsRegistration();
            ViewHandler::render('registration',disciplines:$this->disciplinesModel->getAll(), ages:$this->usersModel->getAllAgesRanges(), grades:$this->gradesModel->getAll());
        }

        public function checkInputsRegistration(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!empty($_POST['name'] && !empty($_POST['firstname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['birthdate'] && !empty($_POST['discipline']) && !empty($_POST['grade'])))) {
                    Validator::registration($_POST['name']);
                    // foreach ($_POST as $key => $value) {
                        
                    // }
                }
            }
        }

    }
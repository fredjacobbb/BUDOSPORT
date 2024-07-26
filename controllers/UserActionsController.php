<?php 

    class UserActionsController extends BaseModel {

        public function __construct(protected $disciplinesModel, protected $usersModel){
            
        }

        public function registration(){
            $this->checkInputsRegistration();
            ViewHandler::render('registration',disciplines:$this->disciplinesModel->getAll(), ages:$this->usersModel->getAllAgesRanges());
        }

        public function checkInputsRegistration(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!empty($_POST['name'] && !empty($_POST['firstname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['birthdate'] && !empty($_POST['discipline'])))) {
                    // passer dans validator
                    
                }else{
                    // flash error vide
                }
            }
        }

    }
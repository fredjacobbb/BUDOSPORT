<?php 

    use Viewer\ViewHandler;
    use Models\BaseModel;

    class UserController extends BaseModel {

        public function __construct($userModel = new UserModel(), $disciplinesModel = new DisciplinesModel()){
        
        }

        public function registration(){
            ViewHandler::render('registration', $disciplinesModel->getAll());
        }

    }
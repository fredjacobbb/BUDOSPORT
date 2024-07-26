<?php 

    use App\Models\UserModel;

    class UserController extends BaseModel {

        public function __construct($userModel = new UserModel()){
        
        }

        public function registration(){
            ViewHandler::render("registration");
        }

    }
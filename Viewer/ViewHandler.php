<?php 

    class ViewHandler {

        public function __construct($adminController = new AdminController(), $userController = new UserController()) {
            
        }

        public static function render($view){
            require "views/$view/$view.php";
            require "views/template.php";
        }

        public function renderAdmin($view){

        }

    }
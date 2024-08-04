<?php 

    class ViewHandler {

        public static function render($view, ?string $redirect = null, ?array $disciplines = null, ?array $users = null, ?array $grades = null, ?object $schedules = null, ?array $ages = null){           
            
            if ($redirect) {
                if (!headers_sent()) {
                    header("Location:./?q=$redirect");
                    exit();
                }
            }
            require "views/$view/$view.php";
            require "views/template.php";
        }

        public function renderAdmin($view){

        }

    }
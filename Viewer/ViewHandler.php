<?php

    class ViewHandler {

        public static function render($view, ?string $redirect = null,?object $user = null, ?array $disciplines = null, ?array $users = null, ?array $grades = null, ?object $schedules = null, ?array $ages = null){           
            require "views/$view/$view.php";
            require "views/template.php";
        }

        public static function redirect($url, ?object $user = null){
            if (!headers_sent()) {
                header("Location: ./?q=$url");
                return $user;
            }
        }

        public function renderAdmin($view){

        }

    }
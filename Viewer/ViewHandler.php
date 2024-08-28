<?php

    class ViewHandler {

        public static function render($view,?object $techniques = null, ?string $redirect = null,?object $user = null,array|object|null $disciplines = null, ?array $users = null, ?array $grades = null, ?object $schedules = null, ?array $ages = null, ?object $students = null, ?array $categories = null, ?object $student = null, ?object $technique = null){           
            require "views/$view/$view.php";
            require "views/template.php";
        }

        public static function redirect($url, ?object $user = null, ?object $techniques = null){
            if (!headers_sent()) {
                header("Location: ./?q=$url");
                if ($user) {
                    return $user;
                }else{
                    return true;
                }
                if ($techniques) {
                    return $techniques;
                }else{
                    return true;
                }
            }
        }

    }
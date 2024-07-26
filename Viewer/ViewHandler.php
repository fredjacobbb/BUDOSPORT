<?php 

    class ViewHandler {

        public static function render($view, ?array $disciplines = null, ?array $users = null, ?array $grades = null, ?array $schedules = null, ?array $ages = null){
            require "views/$view/$view.php";
            require "views/template.php";
        }

        public function renderAdmin($view){

        }

    }
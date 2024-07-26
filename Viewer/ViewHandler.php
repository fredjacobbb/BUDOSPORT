<?php 

    namespace Viewer;

    class ViewHandler {

        public static function render($view, ?object $disciplines = null, ?object $students = null, ?object $grades = null, ?object $schedules = null){
            require "views/$view/$view.php";
            require "views/template.php";
        }

        public function renderAdmin($view){

        }

    }
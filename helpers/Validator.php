<?php 

    class Validator {

        public static array $securesRulesRegistration = [
            "name" => "string | 1-50",
            "firstname" => "string | 1-50",
            "password" => "string | 8-150",
            "birthdate" => "string | 10",
            "discipline" => "int | 1-3",
            "grade" => "int | 1-3"
        ];

        public static function registration($post){
            foreach (self::$securesRulesRegistration as $key => $value) {
                
            }
        }

    }
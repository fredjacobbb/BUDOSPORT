<?php 

    class Validator {

        public static $errors = [];

        public static array $securesRulesRegistration = [
            'name' => ['type' => 'string', 'min' => 2, 'max' => 50],
            "firstname" => ['type' => 'string', 'min' => 2, 'max' => 50],
            "password" => ['type' => 'string', 'min' => 8, 'max' => 150],
            "birthdate" => ['type' => 'string', 'min' => 10, 'max' => 10],
            "discipline" => ['type' => 'string', 'min' => 1, 'max' => 3],
            "grade" => ['type' => 'string', 'min' => 1, 'max' => 3]
        ];

        public static function registration($posts){
            foreach ($posts as $key_post => $post) {
                foreach (self::$securesRulesRegistration as $key_rule => $rule) {
                    if ($key_post == $key_rule) {
                        if (strlen($post) > $rule['max']) {
                            var_dump("La chaine $key_post est trop longue");
                            self::$errors[$key_post] = "La chaine $key_post est trop longue";
                        }elseif (strlen($post) < $rule['min']) {
                            self::$errors[$key_post] = "La chaine $key_post est trop courte";
                        }
                    }
                }
            }
        }

    }
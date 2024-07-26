<?php 

    class Validator {

        public static $errors = [];

        public static array $securesRulesRegistration = [
            'name' => ['type' => 'string', 'min' => 1, 'max' => 50, 'regex' => '/^[A-Za-z][\p{L}-]*$/'],
            "firstname" => ['type' => 'string', 'min' => 1, 'max' => 50, 'regex' => '/^[A-Za-z][\p{L}-]*$/'],
            "password" => ['type' => 'string', 'min' => 8, 'max' => 150],
            "birthdate" => ['type' => 'string', 'min' => 10, 'max' => 10, 'regex' => '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/'],
            "discipline" => ['type' => 'string', 'min' => 1, 'max' => 3],
            "grade" => ['type' => 'string', 'min' => 1, 'max' => 3]
        ];

        public static array $securesRulesLogin = [
            "firstname" => ['type' => 'string', 'min' => 1, 'max' => 50, 'regex' => '/^[A-Za-z][\p{L}-]*$/'],
            "password" => ['type' => 'string', 'min' => 8, 'max' => 150, 'regex' => '/^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9]).{6,})\S$/']
        ];

        public static function registration($posts){
            foreach ($posts as $key_post => $post) {
                foreach (self::$securesRulesRegistration as $key_rule => $rule) {
                    if ($key_post == $key_rule) {
                        if(gettype($post) !== $rule['type']){
                            self::$errors[$key_post] = "La chaine $key_post n'est pas ok";
                        }elseif (strlen($post) > $rule['max']) {
                            self::$errors[$key_post] = "La chaine $key_post est trop longue";
                        }elseif (strlen($post) < $rule['min']) {
                            self::$errors[$key_post] = "La chaine $key_post est trop courte";
                        }elseif (!empty($rule['regex'])){
                            if (!preg_match($rule['regex'], $post)) {
                                self::$errors[$key_post] = "La chaine $key_post n'est pas attendue comme cela !";
                            }
                        }
                    }
                }
            }
        }

        public static function login($posts){
            foreach ($posts as $key_post => $post) {
                foreach (self::$securesRulesLogin as $key_rule => $rule) {
                    if ($key_post !== $key_rule) {
                        if (gettype($post) !== $rule['type']) {
                            self::$errors[$key_post] = "La saisie n'est pas attendue ici !";
                        }elseif (strlen($post) >= $rule['min']) {
                            self::$errors[$key_post] = "La chaine $key_post est trop courte";
                        }elseif (strlen($post) <= $rule['max']) {
                            self::$errors[$key_post] = "La chaine $key_post est trop longue";
                        }elseif (!empty($rule['regex'])) {
                            if (!preg_match($rule['regex'], $post)) {
                                self::$errors[$key_post] = "La chaine $key_post n'est pas attendue !";
                            }
                        }
                    }else {
                        echo "home";die;
                    }
                }
            }
        }

    }
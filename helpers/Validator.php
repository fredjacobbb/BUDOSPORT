<?php 

    class Validator {

        public static $errors = [];

        public static array $securesAddTechnique = [
            'technique_name' => ['type' => 'string', 'min' => 4, 'max' => 50, 'regex' => '/^[A-Za-zÀ-ÿ\'\s,.;!?-]+$/u'],
            'technique_description' => ['type' => 'string', 'min' => 15, 'max' => 255, 'regex' => '/^[A-Za-zÀ-ÿ\'\s,.;!?-]+$/u'],
            'grade_id' => ['type' => 'string', 'min' => 1, 'max' => 4],
            'discipline_id' => ['type' => 'string', 'min' => 1, 'max' => 4],
        ];

        public static array $securesRulesRegistration = [
            'name' => ['type' => 'string', 'min' => 1, 'max' => 50, 'regex' => '/^[A-Za-z][\p{L}-]*$/'],
            'firstname' => ['type' => 'string', 'min' => 1, 'max' => 50, 'regex' => '/^[A-Za-z][\p{L}-]*$/'],
            'email' => ['type' => 'string', 'min' => 5, 'max' => 255],
            'password' => ['type' => 'string', 'min' => 12, 'max' => 255, 'regex' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+{}\[\]:;<>,.?~\/]).{12,255}$/'],
            'birthdate' => ['type' => 'string', 'min' => 10, 'max' => 10, 'regex' => '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/'],
            'discipline' => ['type' => 'string', 'min' => 1, 'max' => 3],
            'grade' => ['type' => 'string', 'min' => 1, 'max' => 3],
        ];

        public static array $securesRulesLogin = [
            'firstname' => ['type' => 'string', 'min' => 1, 'max' => 50, 'regex' => '/^[A-Za-z][\p{L}-]*$/'],
            'password' => ['type' => 'string', 'min' => 12, 'max' => 255, 'regex' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+{}\[\]:;<>,.?~\/]).{12,255}$/'],
            'email' => ['type' => 'string', 'min' => 5, 'max' => 255],
        ];

        public static array $securesRulesResetPassword = [
            'email' => ['type' => 'string', 'min' => 5, 'max' => 150],
            'firstname' => ['type' => 'string', 'min' => 1, 'max' => 50, 'regex' => '/^[A-Za-z][\p{L}-]*$/'],
            'name' => ['type' => 'string', 'min' => 1, 'max' => 150, 'regex' => '/^[A-Za-z][\p{L}-]*$/'],
        ];

        public static array $passwordChanging = [
            'password' => ['type' => 'string', 'min' => 12, 'max' => 255, 'regex' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+{}\[\]:;<>,.?~\/]).{12,255}$/'],
            'password-retyped' => ['type' => 'string', 'min' => 12, 'max' => 255, 'regex' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+{}\[\]:;<>,.?~\/]).{12,255}$/'],
        ];

        public static function registration($posts){
            foreach ($posts as $key_post => $post) {
                foreach (self::$securesRulesRegistration as $key_rule => $rule) {
                    if ($key_post == $key_rule) {
                        if(gettype($post) !== $rule['type']){
                            self::$errors[$key_post] = "La chaine $key_post n\'est pas au format attendu.";
                        }elseif (strlen($post) > $rule['max']) {
                            self::$errors[$key_post] = "La chaine $key_post est trop longue.";
                        }elseif (strlen($post) < $rule['min']) {
                            self::$errors[$key_post] = "La chaine $key_post est trop courte.";
                        }elseif (!empty($rule['regex'])){
                            if (!preg_match($rule['regex'], $post)) {
                                self::$errors[$key_post] = "La chaine $key_post n\'est pas au format attendu regex.";
                            }
                        }elseif ($key_post === 'email') {
                            if(!filter_var($post, FILTER_VALIDATE_EMAIL)){
                                self::$errors[$key_post] = 'L\'adresse mail n\'est pas conforme !';
                            }
                        }
                    }
                }
            }
        }

        public static function login($posts){
            foreach ($posts as $key_post => $post) {
                foreach (self::$securesRulesLogin as $key_rule => $rule) {
                    if ($key_post == $key_rule) {
                        if (gettype($post) !== $rule['type']) {
                            self::$errors[$key_post] = 'La saisie n\'est pas attendue ici !';
                        }elseif (strlen($post) < $rule['min']) {
                            self::$errors[$key_post] = "La chaine $key_post est trop courte";
                        }elseif (strlen($post) > $rule['max']) {
                            self::$errors[$key_post] = "La chaine $key_post est trop longue";
                        }elseif (!empty($rule['regex'])) {
                            if (!preg_match($rule['regex'], $post)) {
                                self::$errors[$key_post] = "La chaine $key_post n'est pas attendue !";
                            }
                        }elseif (!filter_var($post, FILTER_VALIDATE_EMAIL)) {
                            self::$errors[$key_post] = 'L\'adresse mail n\'est pas conforme !';
                        }
                    }
                }
            }
        }

        public static function reset_password($posts){
            foreach ($posts as $key_post => $post) {
                foreach (self::$securesRulesResetPassword as $key_rule => $rule) {
                    if ($key_post == $key_rule) {
                        if (gettype($post) !== $rule['type']) {
                            self::$errors[$key_post] = 'La saisie n\'est pas attendue ici !';
                        }elseif (strlen($post) < $rule['min']) {
                            self::$errors[$key_post] = "La chaine $key_post est trop courte";
                        }elseif (strlen($post) > $rule['max']) {
                            self::$errors[$key_post] = "La chaine $key_post est trop longue";
                        }elseif (!empty($rule['regex'])) {
                            if (!preg_match($rule['regex'], $post)) {
                                self::$errors[$key_post] = "La chaine $key_post n\'est pas attendue !";
                            }
                        }elseif (!filter_var($post, FILTER_VALIDATE_EMAIL)) {
                            self::$errors[$key_post] = "L\'adresse mail n\'est pas conforme !";
                        }
                    }
                }
            }
        }

        public static function passwordChanging($posts){
            foreach ($posts as $key_post => $post) {
                foreach (self::$passwordChanging as $key_rule => $rule) {
                    if ($key_post == $key_rule) {
                        if (gettype($post) !== $rule['type']) {
                            self::$errors[$key_post] = 'La saisie n\'est pas attendue ici !';
                        }elseif (strlen($post) < $rule['min']) {
                            self::$errors[$key_post] = "La chaine $key_post est trop courte";
                        }elseif (strlen($post) > $rule['max']) {
                            self::$errors[$key_post] = "La chaine $key_post est trop longue";
                        }elseif (!empty($rule['regex'])) {
                            if (!preg_match($rule['regex'], $post)) {
                                self::$errors[$key_post] = "La chaine $key_post n\'est pas attendue !";
                            }
                        }
                    }
                }
            }
        }

        public static function addTechnique($posts){
            foreach ($posts as $key_post => $post) {
                foreach (self::$securesAddTechnique as $key_rule => $rule) {
                    if ($key_post == $key_rule) {
                        if (gettype($post) !== $rule['type']) {
                            self::$errors[$key_post] = 'La saisie n\'est pas attendue ici !';
                        }elseif (strlen($post) < $rule['min']) {
                            self::$errors[$key_post] = "La chaine $key_post est trop courte";
                        }elseif (strlen($post) > $rule['max']) {
                            self::$errors[$key_post] = "La chaine $key_post est trop longue";
                        }elseif (!empty($rule['regex'])) {
                            if (!preg_match($rule['regex'], $post)) {
                                self::$errors[$key_post] = "La chaine $key_post n'est pas attendue !";
                            }
                        }
                    }
                }
            }
        }
    }
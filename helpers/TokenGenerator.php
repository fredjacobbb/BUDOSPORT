<?php 

    class TokenGenerator {

        public static function getRandomStringRandomInt($length = 35){
            $stringSpace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $pieces = [];
            $max = mb_strlen($stringSpace, '8bit') - 1;
            for ($i = 0; $i < $length; ++ $i) {
                $pieces[] = $stringSpace[random_int(0, $max)];
            }
            return implode('', $pieces);
        }

        public static function generateCsrfToken(){
            if (empty($_SESSION['csrf_token'])) {
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            }
            return $_SESSION['csrf_token'];
        }

        public static function checkCsrfToken($csrf_token){
            if($csrf_token === $_SESSION['csrf_token']){
                return true;
            }else{
                return false;
            }
        }

    }
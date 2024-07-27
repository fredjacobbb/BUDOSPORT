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

    }
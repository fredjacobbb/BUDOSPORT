<?php 

    namespace Models;

    class ConnectDb {

        public static function connect(){
            try {
                $pdo = new \PDO('mysql:host=mysql;dbname=budosport','root','example');
                return $pdo;
            } catch (\PDOException $e) {
                echo $e->getMessage();
                die;
            }
        }

    }

    

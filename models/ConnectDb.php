<?php 

    class ConnectDb {

        public static function connect(){
            try {
                // return new PDO('mysql:host=mysql-budosport-80.alwaysdata.net;dbname=budosport-80_database','373862','//');
                return new PDO('mysql:host=mysql;dbname=budosport','root','example');
            } catch (PDOException $e) {
                echo $e->getMessage();
                die;
            }
        }

    }
    

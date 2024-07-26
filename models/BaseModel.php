<?php

    namespace Models;
    use Models\ConnectDb;

    class BaseModel {

        protected \PDO $db;

        public function __construct(){
            $this->db = ConnectDb::connect();
        }

    }
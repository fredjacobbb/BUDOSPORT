<?php

    class BaseModel {

        protected PDO $db;

        public function __construct(){
            $this->db = ConnectDb::connect();
        }

    }
<?php

    class SchedulesModel extends BaseModel {

        public function __construct(){
            parent::__construct();
        }

        public function getAll(){
            $sql = "SELECT * FROM `schedules`;";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function getOne(){

        }

    }

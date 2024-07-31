<?php

    class SchedulesModel extends BaseModel {

        public function __construct(){
            parent::__construct();
        }

        public function getAllSchedules(){
            $sql = "SELECT * FROM `schedules` ORDER BY FIELD(day, '1', '2', '3', '4', '5', '6');";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function getOne(){

        }

    }

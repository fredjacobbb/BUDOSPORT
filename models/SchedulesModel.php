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

        public function getSchedulesByAgeAndDiscipline($age_id,$discipline_id){
            $sql = "SELECT * FROM `schedules` WHERE `age_id` = ? AND `discipline_id` = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(1,$age_id, PDO::PARAM_INT);
            $stmt->bindValue(2,$discipline_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function getOne(){

        }

    }

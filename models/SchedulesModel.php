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

        // public function addSchedule($day,$start_at,$end_at,$age_id,$discipline_id){
        //     $sql = 'INSERT INTO schedules (day,start_at,end_at,age_id,discipline_id) SELECT ?,?,?,?,? WHERE NOT EXISTS (SELECT * FROM schedules WHERE day = ? AND );';
        //     $stmt = $this->db->prepare($sql);
        //     $stmt->bindValue(1, $day);
        //     $stmt->bindValue(2,$start_at);
        //     $stmt->bindValue(3,$end_at);
        //     $stmt->bindValue(4, $age_id);
        //     $stmt->bindValue(5, $discipline_id);
        //     $stmt->bindValue(6, $day);
        //     $stmt->bindValue(7, $start_at);
        //     $stmt->bindValue(8, $end_at);
        //     $stmt->execute();
        //     if ($stmt->rowCount() > 0) {
        //         return true;
        //     }else{
        //         return false;
        //     }
        // }

        public function addSchedule($day, $start_at, $end_at, $age_id, $discipline_id) {
            $sql = 'INSERT INTO schedules (day, start_at, end_at, age_id, discipline_id) 
                    SELECT ?,?,?,?,? 
                    WHERE NOT EXISTS (
                        SELECT 1 FROM schedules 
                        WHERE day = ? 
                        AND (
                            (? BETWEEN start_at AND end_at) OR
                            (? BETWEEN start_at AND end_at) OR
                            (start_at BETWEEN ? AND ?) OR
                            (end_at BETWEEN ? AND ?)
                        )
                    );';
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(1, $day);
            $stmt->bindValue(2, $start_at);
            $stmt->bindValue(3, $end_at);
            $stmt->bindValue(4, $age_id);
            $stmt->bindValue(5, $discipline_id);
            $stmt->bindValue(6, $day);
            $stmt->bindValue(7, $start_at);
            $stmt->bindValue(8, $end_at);
            $stmt->bindValue(9, $start_at);
            $stmt->bindValue(10, $end_at);
            $stmt->bindValue(11, $start_at);
            $stmt->bindValue(12, $end_at);
            $stmt->execute();
        
            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function deleteSchedule($schedule_id){
            $sql = "DELETE FROM schedules WHERE schedule_id = ?;";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(1, $schedule_id);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return true;
            }else{
                return false;
            }
        }

    }

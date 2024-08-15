<?php 

    class DisciplinesModel extends BaseModel {

        public function __construct(){
            parent::__construct();
        }

        public function getAllDisciplines(){
            $sql = "SELECT * FROM disciplines;";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function getOne($id){
            $sql = "SELECT `discipline_name` FROM disciplines WHERE discipline_id = ?;";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(1, $id,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        public function getAllDisciplinesByAgeId($age_id){
            $sql = 'SELECT `d`.`discipline_id`, `d`.`discipline_name` FROM `disciplines` AS `d` INNER JOIN `schedules` AS `s` ON `d`.`discipline_id` = `s`.`discipline_id` WHERE `s`.`age_id` = ? GROUP BY `d`.`discipline_id`';
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(1, $age_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

    }
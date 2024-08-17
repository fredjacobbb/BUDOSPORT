<?php 

    class GradesModel extends BaseModel {

        public function __construct(){
            parent::__construct();
        }

        public function getAll(){
            $sql = "SELECT * FROM grades";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function getOne($grade_id){
            $sql = "SELECT grade_name FROM grades WHERE grade_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(1, $grade_id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);

        }
        
    }
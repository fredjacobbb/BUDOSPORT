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
            $sql = "SELECT * FROM disciplines WHERE discipline_id = ?;";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(1, $id,PDO::PARAM_INT);
            $stmt->execute();
        }

    }
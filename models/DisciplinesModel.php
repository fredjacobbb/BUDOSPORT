<?php 

    namespace Models;

    class DisciplinesModel extends BaseModel {

        public function __construct(){

        }

        public function getAll(){
            $sql = "SELECT * FROM disciplines";
            $stmt = $this->db->query($sql);
            var_dump($stmt->fetchAll());
        }

    }
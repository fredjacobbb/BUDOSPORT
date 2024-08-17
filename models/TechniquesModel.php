<?php 

    class TechniquesModel extends BaseModel {

        public function __construct(){
            parent::__construct();
        }

        public function getAllTechniquesByDisciplineGradeCategory($discipline_id, $category,$grade_id){
            $sql = 'SELECT `technique_name`, `technique_description`, `dt`.`technique_id` FROM `disciplines_techniques` AS `dt` INNER JOIN `techniques` ON `dt`.`technique_id` = `techniques`.`technique_id` WHERE `discipline_id` = ? AND `techniques`.`technique_category` = ? AND `techniques`.`grade_id` = ?';
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(1, $discipline_id);
            $stmt->bindValue(2, $category);
            $stmt->bindValue(3, $grade_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function getAllTechniquesByDisciplineGrade($discipline_id,$grade_id){
            $sql = 'SELECT `technique_name`, `technique_category`, `technique_id` FROM `disciplines_techniques` AS `dt` INNER JOIN `techniques` ON `dt`.`technique_id` = `techniques`.`technique_id` WHERE `discipline_id` = ? AND `techniques`.`grade_id` = ?';
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(1, $discipline_id);
            $stmt->bindValue(2, $grade_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function getAllCategoriesByDiscipline($discipline_id, $grade_id){
            $sql = 'SELECT DISTINCT `technique_category` FROM `techniques` AS `t` INNER JOIN disciplines_techniques AS `dt` ON `t` . `technique_id` = `dt`. `technique_id` WHERE `dt`.`discipline_id` = ? AND `t`.`grade_id` = ?';
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(1, $discipline_id);
            $stmt->bindValue(2, $grade_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }



        public function getAllCategories(){
            $sql = 'SELECT DISTINCT `technique_category` FROM `techniques`';
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function insertTechnique($discipline_id,$grade_id,$technique_category,$technique_name,$technique_description){
            $sql = '
                START TRANSACTION;

                INSERT INTO `techniques` (`technique_category`,`technique_name`,`technique_description`,`grade_id`) VALUES (?,?,?,?);

                SET @last_insert_id = LAST_INSERT_ID();

                INSERT INTO `disciplines_techniques` (`discipline_id`,`technique_id`) VALUES (?,@last_insert_id);

                COMMIT;

                ROLLBACK;
            ';
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(1,$technique_category);
            $stmt->bindValue(2,$technique_name);
            $stmt->bindValue(3,$technique_description);
            $stmt->bindValue(4,$grade_id);
            $stmt->bindValue(5,$discipline_id);
            $stmt->execute();
        }

        public function validStudentTechniques($student_id, $technique_id){
            $sql = 'INSERT INTO `techniques_students` (`student_id`,`technique_id`) VALUES (?,?)';
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(1, $student_id);
            $stmt->bindValue(2, $technique_id);
            var_dump($stmt->execute());
        }

        public function getAllTechniquesLearnedByStudentId($student_id,$technique_name){
            $sql = 'SELECT achievement FROM techniques_students INNER JOIN techniques ON techniques_students . technique_id = techniques . technique_id WHERE techniques_students . student_id = ? AND techniques . technique_name = ?';
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(1, $student_id);
            $stmt->bindValue(2, $technique_name);
            $stmt->execute();
            return $stmt->fetchAll();
        }

    }
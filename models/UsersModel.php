<?php

    
    class UsersModel extends BaseModel {

        public function __construct() {
            parent::__construct();
        }

        public function getAllStudents(){
            $sql = "SELECT `student_firstname`,`student_name` FROM `students`";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll();
        }

        public function getStudentByEmailFirstnameLastname($email,$firstname,$lastname){
            $sql = "SELECT student_email, student_token, student_id FROM students WHERE student_email = ? AND student_firstname = ? AND student_name = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(1, $email);
            $stmt->bindValue(2, $firstname);
            $stmt->bindValue(3, $lastname);
            $stmt->execute();
            return $stmt->fetch();
        }

        public function insertUser($name,$firstname,$birthdate,$subscriptionDate,$email,$password,$lastGradeObtention,$disciplineId,$gradeId,$token){
            $age = $this->getAge($birthdate);
            $rangeAgeId = $this->getAgeRangeId($age);
            $sql = "INSERT INTO students(student_name,student_firstname,student_birthdate,subscription_date,student_email,student_password,last_grade_obtention,discipline_id,age_id,grade_id,student_token)
                    SELECT ?,?,?,?,?,?,?,?,?,?,? WHERE NOT EXISTS (SELECT * FROM students WHERE student_name = ? AND student_firstname = ? AND student_email = ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(1,$name);
            $stmt->bindValue(2,$firstname);
            $stmt->bindValue(3,$birthdate);
            $stmt->bindValue(4,$subscriptionDate);
            $stmt->bindValue(5,$email);
            $stmt->bindValue(6,password_hash($password, PASSWORD_BCRYPT));
            $stmt->bindValue(7,$lastGradeObtention);
            $stmt->bindValue(8,$disciplineId);
            $stmt->bindValue(9,$rangeAgeId);
            $stmt->bindValue(10,$gradeId);
            $stmt->bindValue(11,$token);
            $stmt->bindValue(12,$name);
            $stmt->bindValue(13,$firstname);
            $stmt->bindValue(14,$email);
            $stmt->execute();
            return ($this->db->lastInsertId() > 0) ?? false;
        } 

        public function checkHash($email){
            $sql = "SELECT `student_email`, `student_password` FROM `students` WHERE student_email = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(1, $email);
            $stmt->execute();
            return $stmt->fetch();
        }

        public function getAgeRangeId($age){
            $ranges = $this->getAllAgesRanges();
            foreach ($ranges as $range) {
                list($start,$end) = explode("-",$range[1]);
                $start = intval($start);
                $end = intval($end);
                if ($age >= $start && $age <= $end) {
                    return $range[0];
                }
            }
        }

        public function getAllAgesRanges(){
            $sql = "SELECT * FROM `ages_ranges`";
            $res = $this->db->query($sql);
            $res->execute();
            return $res->fetchAll();
        }

        public function getAge($birthdate){
            $birthdate = new \DateTime($birthdate);
            return $birthdate->diff(new \DateTime())->y;
        }

        public function getAgeId($range){
            $sql = "SELECT age_id FROM ages_ranges WHERE age_tranche = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(1,$range);
            $stmt->execute();
            $range = $stmt->fetch();
            return $range[0];
        }

    }
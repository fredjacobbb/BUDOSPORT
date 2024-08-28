<?php
    
    class UsersModel extends BaseModel {

        public function __construct() {
            parent::__construct();
        }

        public function getAllStudents(){
            $sql = 'SELECT * FROM `students`';
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function getStudentByEmailFirstname($email,$firstname){
            $sql = 'SELECT * FROM `students` AS `s` INNER JOIN `grades` AS `g` ON `g`.`grade_id` = `s`.`grade_id` WHERE `s`.`student_email` = ? AND `s`.`student_firstname` = ?;';
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(1, $email);
            $stmt->bindValue(2, $firstname);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        public function checkUserExistByToken($token){
            $sql = 'SELECT 1 FROM students WHERE student_token = ?;';
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(1,$token);
            $stmt->execute();
            return $stmt->fetch();
        }
       
        public function getStudentByToken($token){
            $sql = 'SELECT * FROM students WHERE student_token = ?;';
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(1,$token);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        public function validStudentTokenMail($token){
            $sql = 'UPDATE students SET student_valid = ? WHERE student_token = ?';
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(1, '1');
            $stmt->bindValue(2, $token);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return true;
            }else{
                return false;
            }
        }

        public function deleteStudentByToken($student_token){
            $sql = 'UPDATE students SET deleted_at = NOW() WHERE student_token = ?';
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(1,$student_token);
            $stmt->execute();
        }

        public function getStudentByEmailFirstnameLastname($email,$firstname,$lastname){
            $sql = 'SELECT student_email, student_token, student_id FROM students WHERE student_email = ? AND student_firstname = ? AND student_name = ?';
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
            $sql = 'INSERT INTO students(student_name,student_firstname,student_birthdate,subscription_date,student_email,student_password,last_grade_obtention,discipline_id,age_id,grade_id,student_token)
                    SELECT ?,?,?,?,?,?,?,?,?,?,? WHERE NOT EXISTS (SELECT * FROM students WHERE student_name = ? AND student_firstname = ? AND student_email = ?)';
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

        public function checkHash($email,$firstname){
            $sql = 'SELECT `student_password` FROM `students` WHERE student_email = ? AND student_firstname = ?';
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(1, $email);
            $stmt->bindValue(2, $firstname);
            $stmt->execute();
            if($student = $stmt->fetch()){
                return $student['student_password'];
            }
        }

        public function checkPasswordLogin($email,$firstname,$password){
            $passwordHash = $this->checkHash($email, $firstname);
            $sql = 'SELECT * FROM students WHERE student_email = ? AND student_firstname = ?';
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(1, $email);
            $stmt->bindValue(2, $firstname);
            $stmt->execute();
            $user_info = $stmt->fetch(PDO::FETCH_OBJ);
            if($user_info){
                if ($user_info->student_valid === 0) {
                    throw new Exception('Veuillez activer votre compte, via le lien envoyé sur la boite email, $email');
                }
                if(!password_verify($password, $passwordHash)){
                    throw new Exception('Problème lors de la connexion');
                }
                return $user_info;
            }else{
                return false;
            }
        }

        public function getStudentsByDisciplineAndAgeId($discipline_id, $age_id){
            $sql = 'SELECT * FROM students WHERE discipline_id = ? AND age_id = ? AND student_valid = 1 AND deleted_at IS NULL ;';
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(1, $discipline_id);
            $stmt->bindValue(2, $age_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function getAgeRangeId($age){
            foreach ($this->getAllAgesRanges() as $age_range) {
                $ages = explode('-', $age_range->age_tranche);                
                if ($age >= intval($ages[0]) && $age <= intval($ages[1])) {
                    return intval($age_range->age_id);
                }
            }      
        }

        public function getAllAgesRanges(){
            $sql = 'SELECT * FROM `ages_ranges`';
            $stmt = $this->db->query($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function getAge($birthdate){
            $birthdate = new \DateTime($birthdate);
            return $birthdate->diff(new \DateTime())->y;
        }
        

        public function getAgeId($range){
            $sql = 'SELECT age_id FROM ages_ranges WHERE age_tranche = ?';
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(1,$range);
            $stmt->execute();
            $range = $stmt->fetch();
            return $range[0];
        }

        public function changePassword($password, $token){
            $password = password_hash($password, PASSWORD_BCRYPT);
            $sql = 'UPDATE students SET student_password = ? WHERE student_token = ?;';
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(1,$password);
            $stmt->bindValue(2, $token);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return true;
            }else{
                return false;
            }
        }

        public function gradePassStudent($student_id){
            $sql = 'UPDATE students SET grade_id = grade_id + 1 WHERE student_id = ? AND grade_id <= 7';
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(1, $student_id);
            $stmt->execute();
        }

        public function connectAdmin($pseudo, $password){
            $sql = 'SELECT `admin_password` FROM `admin` WHERE admin_name = ?';
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(1,$pseudo);
            $stmt->execute();
            $admin_info = $stmt->fetch(PDO::FETCH_OBJ);
            if($admin_info){
                if(!password_verify($password, $admin_info->admin_password)){
                    throw new Exception('Problème lors de la connexion');
                }
                return $admin_info;
            }else{
                return false;
            }
        }

        // KEEP FOR CHANGE INFO

        // public function insertAd(){
        //     $password = password_hash('charlesbaudelaire', PASSWORD_BCRYPT);
        //     $sql = 'INSERT INTO `admin` (`admin_name`, `admin_password`) VALUES (?,?);';
        //     $stmt = $this->db->prepare($sql);
        //     $stmt->bindValue(1,'admin');
        //     $stmt->bindValue(2,$password);
        //     $stmt->execute();
        // }

    }
<?php     

    use Leaf\Flash;

    class AdminController {

        public function __construct(protected $schedulesController = new SchedulesController(new SchedulesModel(), new DisciplinesModel(), new UsersModel()), protected $disciplines = new DisciplinesModel(), protected $users = new UsersModel(), protected $techniquesController = new TechniquesController(new TechniquesModel()), protected $techniques = new TechniquesModel(), protected $gradeModel = new GradesModel()){
            
        }

        protected $students;

        protected $student;

        public function schedulesController(){
            $schedules = $this->schedulesController->listSchedules();
            $disciplines = $this->disciplines->getAllDisciplines();
            ViewHandler::render("schedules", schedules:$schedules, disciplines:$disciplines);
            
        }

        public function deleteScheduleController(){
            if($this->schedulesController->deleteSchedule()){
                Flash::set('Le créneau a bien été supprimé.', 'schedule_success');
            }else{
                Flash::set('Une erreur est survenue lors de la suppression du créneau.', 'schedule_error');
            }
            $this->schedulesController();
        }

        public function addScheduleController(){
            if($this->schedulesController->addSchedule()){
                Flash::set('Le créneau à bien été ajouté.', 'schedule_success');
            }else{
                Flash::set('La plage du créneau est prise.', 'schedule_error');
            }
            $this->schedulesController();
        }

        public function listStudentsController(){
            $this->students = new stdClass();
            $this->students->ages = $this->users->getAllAgesRanges();
            foreach ($this->students->ages as $key => $ages) {
                $this->students->ages[$key]->disciplines = $this->disciplines->getAllDisciplines();
                foreach ($this->students->ages[$key]->disciplines as $key_discipline => $discipline) {
                    $this->students->ages[$key]->disciplines[$key_discipline]->students = $this->users->getStudentsByDisciplineAndAgeId($this->students->ages[$key]->disciplines[$key_discipline]->discipline_id,$this->students->ages[$key]->age_id);
                    foreach ($this->students->ages[$key]->disciplines[$key_discipline]->students as $key_student => $student) {
                        $this->students->ages[$key]->disciplines[$key_discipline]->students[$key_student]->categories = $this->techniques->getAllCategories();
                        foreach ($this->students->ages[$key]->disciplines[$key_discipline]->students[$key_student]->categories as $key_category => $category) {
                            $this->students->ages[$key]->disciplines[$key_discipline]->students[$key_student]->categories[$key_category]->technique_name =  $this->techniques->getAllTechniquesByDisciplineGradeCategory($this->students->ages[$key]->disciplines[$key_discipline]->students[$key_student]->discipline_id,$this->students->ages[$key]->disciplines[$key_discipline]->students[$key_student]->grade_id,$this->students->ages[$key]->disciplines[$key_discipline]->students[$key_student]->categories[$key_category]->technique_category);
                        }                    
                    }   
                }
            }        
            ViewHandler::render('students', students: $this->students);            
        }

        public function profilStudentController(){
            ob_start();
            $token = $_GET['student_tk'] ?? '';
            if (!empty($token)) {
                $this->student = new stdClass();
                // check if student exist by token in db
                if ($this->student = $this->users->getStudentByToken($token)) {
                    $this->student->nbTechniques = 0;
                    $this->student->validTechniques = 0;

                    // get student discipline via discipline_id in students table
                    $this->student->discipline = $this->disciplines->getOne($this->student->discipline_id);
                    // get all techniques category by discipline_id of student and his grade 
                    $this->student->categories = $this->techniques->getAllCategoriesByDiscipline($this->student->discipline_id, $this->student->grade_id);
                    foreach ($this->student->categories as $key_category => $category) {
                        $this->student->categories[$key_category]->techniques = $this->techniques->getAllTechniquesByDisciplineGradeCategory($this->student->discipline_id, $this->student->categories[$key_category]->technique_category,$this->student->grade_id);
                        foreach($this->student->categories[$key_category]->techniques as $key_technique => $technique){
                            $this->student->nbTechniques += 1;
                            $this->student->categories[$key_category]->techniques[$key_technique]->valid = $this->techniques->getAllTechniquesLearnedByStudentId($this->student->student_id, $technique->technique_name);
                            if($this->student->categories[$key_category]->techniques[$key_technique]->valid){
                                $this->student->validTechniques += 1;
                            }
                        }
                    }

                    $this->student->grade_name = $this->gradeModel->getOne($this->student->grade_id);


                    if ($this->student->nbTechniques === $this->student->validTechniques) {
                        // passage au grade superieur if not black belt
                        $this->users->gradePassStudent($this->student->student_id);
                        header("Location: /?q=admin&action=student&student_tk={$this->student->student_token}");
                        exit();
                    }

                    $birthdate = new DateTime($this->student->student_birthdate);

                    $this->student->age = $birthdate->diff(new DateTime('now'))->y;

                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        foreach($_POST as $techniques_ids){
                            foreach ($techniques_ids as $technique_id) {
                                $this->techniques->validStudentTechniques($this->student->student_id, $technique_id);
                            }
                        }
                        header("Location: /?q=admin&action=student&student_tk={$this->student->student_token}");
                        exit();
                    }
                    ViewHandler::render('student-profil', student: $this->student);    
                }
            }
            ob_end_flush();
        }

        public function addTechniqueController(){
            $this->techniquesController->addTechniqueController();
        }

        public function validStudentTechniquesController($student_id, array $techniques_ids){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                var_dump("ok");die;
                foreach ($techniques_ids as $key => $technique_id) {
                    $this->techniques->validStudentTechniques($student_id, $technique_id);
                }
            }
        }

    }

    

<?php     

    use Leaf\Flash;

    class AdminController {

        public function __construct(protected $schedulesController = new SchedulesController(new SchedulesModel(), new DisciplinesModel(), new UsersModel()), protected $disciplines = new DisciplinesModel(), protected $users = new UsersModel()){
            
        }

        protected $students;

        public function schedulesController(){
            $schedules = $this->schedulesController->listSchedules();
            // $disciplines = $this->disciplines->getAllDisciplines();
            ViewHandler::render("schedules", schedules:$schedules);
            
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
                }
            }
            ViewHandler::render('students', students: $this->students);            
        }


    }
<?php     

    use Leaf\Flash;

    class AdminController {

        public function __construct(protected $schedulesController = new SchedulesController(new SchedulesModel(), new DisciplinesModel(), new UsersModel()), protected $disciplines = new DisciplinesModel()){
            
        }

        public function schedulesController(){
            $schedules = $this->schedulesController->listSchedules();
            $disciplines = $this->disciplines->getAllDisciplines();
            ViewHandler::render("schedules", schedules:$schedules, disciplines:$disciplines);
            
        }

        public function deleteScheduleController(){
            if($this->schedulesController->deleteSchedule()){
                Flash::set('Le créneau a été supprimé.', 'admin_schedule');
            }else{
                Flash::set('Problème lors de la suppression.', 'admin_schedule');
            }
        }

        public function addScheduleController(){
            if($this->schedulesController->addSchedule()){
                Flash::set('Le créneau à bien été ajouté.', 'admin_schedule_success');
            }else{
                Flash::set('Le créneau existe déja.', 'admin_schedule_error');
            }
            $this->schedulesController();
        }


    }
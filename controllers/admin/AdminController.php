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


    }
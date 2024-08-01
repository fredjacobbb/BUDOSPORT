<?php     

    class AdminController {

        public function __construct(protected $schedulesController = new SchedulesController(new SchedulesModel(), new DisciplinesModel(), new UsersModel())){
            
        }

        public function schedulesController(){
            $schedules = $this->schedulesController->listSchedules();
            ViewHandler::render("schedules", schedules:$schedules);
        }


    }
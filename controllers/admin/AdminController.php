<?php     

    class AdminController {

        public function __construct(protected $schedulesController = new SchedulesController(new SchedulesModel(), new DisciplinesModel(), new UsersModel())){
            
        }

        public function schedulesController(){
            $this->schedulesController->listSchedules();
        }


    }
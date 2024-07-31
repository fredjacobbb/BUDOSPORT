<?php 


    class SchedulesController  {
        
        public function __construct(protected $schedulesModel, protected $disciplinesModel, protected $usersModel){}

        protected $days = ['lundi','mardi','mercredi', 'jeudi','vendredi','samedi','dimanche'];


        public function listSchedules(){
            foreach ($this->schedulesModel->getAll() as $key => $value) {
                foreach ($this->days as $key => $value) {
                    var_dump($key);
                }
            }
            die;
        }


    }
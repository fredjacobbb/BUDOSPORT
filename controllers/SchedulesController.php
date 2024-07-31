<?php 

    class SchedulesController  {
        
        public function __construct(protected $schedulesModel, protected $disciplinesModel, protected $usersModel){}

        protected $days = ['lundi','mardi','mercredi', 'jeudi','vendredi','samedi'];

        protected $allSchedules = [];
        
        public function listSchedules(){
            foreach ($this->usersModel->getAllAgesRanges() as $age_range) {
                
            }
        }

        // public function listSchedules(){
        //     foreach ($this->usersModel->getAllAgesRanges() as $age_range) {
        //         foreach ($this->schedulesModel->getAllSchedules() as $schedule) {
        //             if ($schedule->age_id === $age_range->age_id) {
        //                 foreach ($this->disciplinesModel->getAll() as $discipline) {
        //                     if ($schedule->discipline_id === $discipline->discipline_id) {
        //                         foreach($this->days as $int_day => $day){
        //                             if ($schedule->day === $int_day + 1) {
        //                                 # code...
        //                                 // $this->fuck['ages'][$age_range->age_tranche][$discipline->discipline_name][$day] = $schedule;
        //                                 $this->fuck['ages'][$age_range->age_tranche]['disciplines'][$discipline->discipline_name]['days'][$day] = $schedule;
        //                             }
        //                         }
        //                     }
        //                 }
        //             }
        //         }
        //     }
        //     var_dump($this->fuck);die;
        // }

    }
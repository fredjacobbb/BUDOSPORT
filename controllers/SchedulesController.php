<?php 

    class SchedulesController  {
        
        public function __construct(protected $schedulesModel, protected $disciplinesModel, protected $usersModel){}

        protected $days = ['lundi','mardi','mercredi', 'jeudi','vendredi','samedi'];

        protected $schedulesList;
        
        public function listSchedules(){

            $this->schedulesList = new stdClass();
            $this->schedulesList->ages = $this->usersModel->getAllAgesRanges();
            foreach ($this->schedulesList->ages as $key_age=>$age_range) {
                $this->schedulesList->ages[$key_age]->disciplines = $this->disciplinesModel->getAllDisciplinesByAgeId($age_range->age_id);
                foreach ($this->schedulesList->ages[$key_age]->disciplines as $key_discipline => $discipline) {
                    $this->schedulesList->ages[$key_age]->disciplines[$key_discipline]->schedules = $this->schedulesModel->getSchedulesByAgeAndDiscipline($age_range->age_id, $discipline->discipline_id);  
                }
            }
            return $this->schedulesList;
        }

    }
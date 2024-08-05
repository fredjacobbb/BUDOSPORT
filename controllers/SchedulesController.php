<?php 
use Leaf\Flash;

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

        public function addSchedule(){
            if (!empty($_POST['day']) && !empty($_POST['start_at'] && !empty($_POST['end_at']) && !empty($_POST['discipline_id']) && !empty($_POST['age_id']))) {
                if($this->schedulesModel->addSchedule($_POST['day'], $_POST['start_at'], $_POST['end_at'], $_POST['age_id'], $_POST['discipline_id'])){
                    Flash::set('Le créneau a été inséré.');
                    return true;
                }else{
                    Flash::set('Le créneau existe déja.');
                    return false;
                }
            }
        }

        public function deleteSchedule(){
            if (!empty($_GET['delete'])) {
                if($this->schedulesModel->deleteSchedule($_GET['delete'])){
                    return true;
                }else{
                    return false;
                }
            }
        }

    }
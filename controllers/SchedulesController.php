<?php 

    class SchedulesController  {
        
        public function __construct(protected $schedulesModel, protected $disciplinesModel, protected $usersModel){}

        protected $days = ['lundi','mardi','mercredi', 'jeudi','vendredi','samedi'];

        protected $schedulesList;
        
        public function listSchedules(){

            $this->schedulesList = new ArrayObject();
            $this->schedulesList->ages = [];
            $this->schedulesList->disciplines = new ArrayObject();

        
            foreach ($this->usersModel->getAllAgesRanges() as $age_range) {
                foreach ($this->disciplinesModel->getAllDisciplines() as $discipline) {
                   foreach ($this->schedulesModel->getAllSchedules() as $schedule) {
                        if ($schedule->age_id === $age_range->age_id) {
                            if ($schedule->discipline_id === $discipline->discipline_id) {
                                foreach ($this->days as $item_day => $day) {
                                    if ($schedule->day === $item_day + 1) {

                                        $age = (object) array('value' => $age_range->age_tranche);
                                        // $this->schedulesList->ages['age'][$age_range->age_tranche]['discipline'][$discipline->discipline_name]['day'][$day] = $schedule;
                                        $this->schedulesList->ages[] = $age;
                                        
                                    }
                                }
                            }
                        }
                    }
                }
            }
            foreach ($this->schedulesList as $key => $value) {
                var_dump($value);
            }
            die;
            return $this->schedulesList;
        }

    }
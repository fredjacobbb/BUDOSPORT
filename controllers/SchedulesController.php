<?php 

    class SchedulesController  {
        
        public function __construct(protected $schedulesModel, protected $disciplinesModel, protected $usersModel){}

        protected $days = ['lundi','mardi','mercredi', 'jeudi','vendredi','samedi'];

        protected $schedulesList;
        
        public function listSchedules(){

            $this->schedulesList = new stdClass();
            // $this->schedulesList->ages = [];
            $this->schedulesList->ages = $this->usersModel->getAllAgesRanges();
            foreach ($this->schedulesList->ages as $key_age=>$age_range) {
                $this->schedulesList->ages[$key_age]->disciplines = $this->disciplinesModel->getAllDisciplinesByAgeId($age_range->age_id);

                // $this->schedulesList->ages[$age_range->age_tranche] = ['value' => $age_range->age_tranche];
                foreach ($this->disciplinesModel->getAllDisciplines() as $key_discipline => $discipline) {
                    $this->schedulesList->ages[$key_age]->disciplines[$key_discipline]->schedules = $this->schedulesModel->getSchedulesByAgeAndDiscipline($age_range->age_id, $discipline->discipline_id);

                    // $this->schedulesList->ages[$age_range->age_tranche][$discipline->discipline_name] = ['value' => $discipline->discipline_name];
                    foreach ($this->schedulesModel->getAllSchedules() as $schedule) {
                        if ($schedule->age_id === $age_range->age_id) {
                            if ($schedule->discipline_id === $discipline->discipline_id) {
                                foreach ($this->days as $item_day => $day) {
                                    if ($schedule->day === $item_day + 1) {
                                        // $this->schedulesList->ages = (object) array('age' => $age_range->age_tranche);
                                        // $this->schedulesList->ages->disciplines = (object) array('disicpline' => $discipline->discipline_name);
                                        // $this->schedulesList->ages->disciplines->schedules[] = (object) array('schedule' => $schedule);
                                        // $this->schedulesListAll[] = $this->schedulesList;

                                        


                                        // $this->schedulesList->ages->disciplines = (object) array(
                                        //     'discipline' => $discipline->discipline_name
                                        // );

                                        // $this->schedulesList->ages->disciplines->schedules = (object) array(
                                        //     'schedule' => $schedule
                                        // );

                                        // $this->schedulesListAll[] = $this->schedulesList;
                                        
                                    }
                                }
                            }
                        }
                    }
                }
            }
            var_dump($this->schedulesList);die;
        }

    }
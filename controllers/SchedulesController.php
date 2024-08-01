<?php 

    class SchedulesController  {
        
        public function __construct(protected $schedulesModel, protected $disciplinesModel, protected $usersModel){}

        protected $days = ['lundi','mardi','mercredi', 'jeudi','vendredi','samedi'];

        protected $schedulesList;

        protected $schedulesListAll;
        
        public function listSchedules(){

            $this->schedulesList = new ArrayObject();
            $this->schedulesList->ages = new ArrayObject();
        
            foreach ($this->usersModel->getAllAgesRanges() as $age_range) {

                foreach ($this->disciplinesModel->getAllDisciplines() as $discipline) {
                   foreach ($this->schedulesModel->getAllSchedules() as $schedule) {
                        if ($schedule->age_id === $age_range->age_id) {
                            if ($schedule->discipline_id === $discipline->discipline_id) {
                                foreach ($this->days as $item_day => $day) {
                                    if ($schedule->day === $item_day + 1) {

                                        // $this->schedulesList->ages = (object) array('age' => $age_range->age_tranche);
                                        // $this->schedulesList->ages->disciplines = (object) array('disicpline' => $discipline->discipline_name);
                                        // $this->schedulesList->ages->disciplines->schedules[] = (object) array('schedule' => $schedule);
                                        // $this->schedulesListAll[] = $this->schedulesList;

                                        // $this->schedulesList->ages[] = (object) array(
                                        //     'age' => (object) array(
                                        //         'discipline' => $discipline->discipline_name 
                                        //     )   
                                        // );


                                        $this->schedulesList->ages = (object) array(
                                            'age' => $age_range->age_tranche
                                        );

                                        $this->schedulesList->ages->disciplines = (object) array(
                                            'discipline' => $discipline->discipline_name
                                        );

                                        $this->schedulesList->ages->disciplines->schedules = (object) array(
                                            'schedule' => $schedule
                                        );
                                        
                                    }
                                }
                            }
                        }
                    }
                }
            }
            var_dump($this->schedulesList->ages);die;
        }

    }
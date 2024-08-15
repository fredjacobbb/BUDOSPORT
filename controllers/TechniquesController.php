<?php 

    class TechniquesController {

        public function __construct(protected $techniques = new TechniquesModel(), protected $disciplines = new DisciplinesModel(), protected $grades = new GradesModel()){

        }

        protected $categories = ['atémis', 'projections', 'cléfs', 'immobilisations', 'défenses', 'étranglements'];

        public function addTechniqueController(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->techniques->insertTechnique(
                    $_POST['discipline_id'],
                    $_POST['grade_id'],
                    $_POST['category'],
                    $_POST['technique_name'],
                    $_POST['technique_description'],
                );
            }else{
                ViewHandler::render('techniques', categories:$this->categories,grades: $this->grades->getAll(), disciplines: $this->disciplines->getAllDisciplines());
            }
        }

        

    }
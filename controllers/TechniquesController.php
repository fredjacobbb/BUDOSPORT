<?php 

    use Leaf\Flash;

    class TechniquesController {

        public function __construct(protected $techniques = new TechniquesModel(), protected $disciplines = new DisciplinesModel(), protected $grades = new GradesModel()){

        }

        protected $categories = ['atémis', 'projections', 'cléfs', 'immobilisations', 'défenses', 'étranglements'];

        public function addTechniqueController(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                try{
                    if (empty($_POST['discipline_id']) || !intval($_POST['discipline_id']) || strlen($_POST['discipline_id']) > 4) {
                        throw new Exception('Le champ discipline contient une erreur ou vide.');
                    }
                    if (empty($_POST['grade_id']) || !intval($_POST['grade_id'])) {
                        throw new Exception('Le champ grade contient une erreur ou vide.');
                    }
                    if (empty($_POST['category']) || !in_array($_POST['category'], $this->categories) ) {
                        throw new Exception('Le champ category contient une erreur ou vide.');
                    }
                    if (empty($_POST['technique_name'])) {
                        Validator::$errors['technique_name'] = "La chaine est vide.";
                        throw new Exception('Le champ nom de technique dépasse ou vide.');
                    }
                    Validator::addTechnique($_POST);
                    if (Validator::$errors) {
                        Validator::$errors['password-retyped'] = "Les mots de passe ne correspondent pas !";
                        throw new Exception('Erreur lors de l\'insertion, vérifier les champs.');
                    }
                    $this->techniques->insertTechnique(
                        $_POST['discipline_id'],
                        $_POST['grade_id'],
                        $_POST['category'],
                        $_POST['technique_name'],
                        $_POST['technique_description'],
                    );
                    header("Location: ?real=admin&action=dashboard-techniques");
                }catch (Exception $err){
                    Flash::set($err->getMessage(),'error_');
                    ViewHandler::render('add-technique', grades : $this->grades->getAll(), disciplines: $this->disciplines->getAllDisciplines(), categories: $this->categories);
                }
            }else{
                ViewHandler::render('add-technique', grades : $this->grades->getAll(), disciplines: $this->disciplines->getAllDisciplines(), categories: $this->categories);
            }
        }

        public function deleteTechniqueController(){
            try {
                if (empty($_GET['technique_id']) || strlen($_GET['technique_id']) > 4 || strlen($_GET['technique_id'] < 1)) {
                    throw new Exception('Erreur lors de la suppression, vérifier les champs.');
                }
                if(!$this->techniques->deleteTechnique($_GET['technique_id'])){
                    throw new Exception('La technique n\'existe pas.');
                }
                Flash::set("La technique a bien été supprimée.", 'success_delete');
                header("Location: ?real=admin&action=dashboard-techniques");
            } catch (Exception $err) {
                Flash::set($err->getMessage(), 'error_delete');
                ViewHandler::render('dashboard-techniques', $this->techniques);
            }
        }

        public function editTechniqueController(){
            if(!empty($_POST['technique_name']) && !empty($_POST['technique_description'])){
                $this->techniques->editTechnique($_POST['technique_id'], $_POST['technique_category'], $_POST['technique_name'], $_POST['technique_description'], $_POST['grade_id']);
                header("Location: ?real=admin&action=dashboard-techniques");
            }else{
                try{
                    if (empty($_GET['technique_id'])) {
                        throw new Exception('La technique n\'est pas renseignée.');
                    }
                    $technique = $this->techniques->getTechnique($_GET['technique_id']);
                    ViewHandler::render('edit-technique', technique: $technique);
                } catch (Exception $err) {
                    Flash::set($err->getMessage());
                    ViewHandler::render('dashboard-techniques', $this->techniques);
                }
            }
        }

        

    }
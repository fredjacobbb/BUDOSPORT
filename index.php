<?php 

    require_once __DIR__ . '/vendor/autoload.php';

    use Leaf\Http\Session;

    Session::start();

    require 'helpers/TokenGenerator.php';
    require 'helpers/Validator.php';

    require 'models/BaseModel.php';
    require 'models/ConnectDb.php';
    require 'models/UsersModel.php';
    require 'models/DisciplinesModel.php';
    require 'models/GradesModel.php';
    require 'models/SchedulesModel.php';
    require 'models/TechniquesModel.php';
    
    require 'viewer/ViewHandler.php';

    require 'controllers/admin/AdminController.php';
    require 'controllers/UserActionsController.php';
    require 'controllers/SchedulesController.php';
    require 'controllers/TechniquesController.php';

    $userActionsController = new UserActionsController(new DisciplinesModel(), new UsersModel(), new GradesModel(), new TechniquesModel());
    $disciplinesModel = new DisciplinesModel();
    $schedulesController = new SchedulesController(new SchedulesModel(), new DisciplinesModel(), new UsersModel());
    $adminActionsController = new AdminController(new SchedulesController(new SchedulesModel(), new DisciplinesModel(), new UsersModel()));

    TokenGenerator::generateCsrfToken();

    if (isset($_GET['q'])) {
        switch ($_GET['q']) {
            case 'disciplines':
                $userActionsController->listDisciplines();
                break;
            case 'registration':
                $userActionsController->registration();
                break;
            case 'login':
                $userActionsController->login();
                break;
            case 'forgot-password':
                $userActionsController->passwordForgotten();
                break;
            case 'change-password':
                $userActionsController->changePassword();
                break;
            case 'mon-espace':
                $userActionsController->mySpace();
                break;
            case 'valid-account-mail':
                $userActionsController->validAccountMail();
                break;
            case 'disconnect':
                $userActionsController->disconnect();
                break;
            case 'schedules':
                ViewHandler::render('schedules', schedules: $schedulesController->listSchedules());
                break;
            case 'admin':
                // create FAKE admin form here
                ViewHandler::render('fake-admin');
                break;
            default:
                $disciplines = $disciplinesModel->getAllDisciplines();
                ViewHandler::render('home', disciplines: $disciplines);
                break;
        }
    }else if(isset($_GET['real'])){
        switch ($_GET['real']) {
            case 'admin':
                if (isset($_GET['action'])) {
                    switch ($_GET['action']) {
                        case 'dashboard-students':
                            $adminActionsController->listStudentsController();
                            break;
                        case 'student':
                            $adminActionsController->profilStudentController();
                            break;
                        case 'delete':
                            $adminActionsController->deleteStudentController();
                            break;
                        case 'dashboard-schedules':
                            $adminActionsController->schedulesController();
                            break;
                        case 'add-schedule':
                            $adminActionsController->addScheduleController();
                            break;
                        case 'delete-schedule':
                            $adminActionsController->deleteScheduleController();
                            break;
                        case 'add-technique':
                            $adminActionsController->addTechniqueController();
                            break;
                        default:
                            ViewHandler::redirect('home');
                            break;
                    }
                }
                break;

            default:
                ViewHandler::redirect('home');
                break;
        }
    }else{
        $disciplines = $disciplinesModel->getAllDisciplines();
        ViewHandler::render('home', disciplines:$disciplines);

    }


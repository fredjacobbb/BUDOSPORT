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
    
    require 'viewer/ViewHandler.php';

    require 'controllers/admin/AdminController.php';
    require 'controllers/UserActionsController.php';
    require 'controllers/SchedulesController.php';

    // $adminController = new AdminController();
    $userActionsController = new UserActionsController(new DisciplinesModel(), new UsersModel(), new GradesModel());
    $adminActionsController = new AdminController(new SchedulesController(new SchedulesModel(), new DisciplinesModel(), new UsersModel()));

    if (isset($_GET['q'])) {
        switch ($_GET['q']) {
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
            case 'admin':
                if (isset($_GET['action'])) {
                    switch ($_GET['action']) {
                        case 'schedules':
                            $adminActionsController->schedulesController();
                            break;
                        case 'add-schedule':
                            $adminActionsController->addScheduleController();
                            break;
                        case 'delete-schedule':
                            $adminActionsController->deleteScheduleController();
                            break;
                        default:
                            break;
                    }
                }
                break;
            default:
                ViewHandler::render('home');
                break;
        }
    }else{
        ViewHandler::render('home');
    }


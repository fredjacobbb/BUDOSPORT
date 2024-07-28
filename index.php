<?php 

    require_once __DIR__ . '/vendor/autoload.php';

    require 'helpers/TokenGenerator.php';
    require 'helpers/Validator.php';

    require 'models/BaseModel.php';
    require 'models/ConnectDb.php';
    require 'models/UsersModel.php';
    require 'models/DisciplinesModel.php';
    require 'models/GradesModel.php';
    
    require 'viewer/ViewHandler.php';

    require 'controllers/admin/AdminController.php';
    require 'controllers/UserActionsController.php';
    require 'controllers/SchedulesController.php';

    // $adminController = new AdminController();
    $userActionsController = new UserActionsController(new DisciplinesModel(), new UsersModel(), new GradesModel(), new Validator());

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
            case 'admin':
                if (isset($_GET['action'])) {
                    switch ($_GET['action']) {
                        case 'schedulesPanel':
                            
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


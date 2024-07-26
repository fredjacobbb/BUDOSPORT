<?php 

    require 'models/BaseModel.php';
    require 'models/ConnectDb.php';
    require 'viewer/ViewHandler.php';
    require 'models/UsersModel.php';
    require 'models/DisciplinesModel.php';

    require 'controllers/admin/AdminController.php';
    require 'controllers/UserActionsController.php';
    require 'controllers/SchedulesController.php';

    // $adminController = new AdminController();
    $userActionsController = new UserActionsController(new DisciplinesModel(), new UsersModel());

    if (isset($_GET['q'])) {
        switch ($_GET['q']) {
            case 'registration':
                $userActionsController->registration();
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
                
                break;
        }
    }else{
        echo "home";
        die;
    }


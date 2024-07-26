<?php 

    require 'models/BaseModel.php';
    require 'models/ConnectDb.php';
    require 'models/UserModel.php';
    require 'viewer/ViewHandler.php';

    require 'controllers/admin/AdminController.php';
    require 'controllers/UserController.php';

    $adminController = new AdminController();
    $userController = new UserController();

    if (isset($_GET['q'])) {
        switch ($_GET['q']) {
            case 'registration':
                $userController->registration();
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
                $userController;
                break;
        }
    }else{
        echo "home";
    }


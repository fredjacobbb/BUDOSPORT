<?php 

    session_start();

    require __DIR__ . "/config/config.php";

    require "vendor/autoload.php";
    require "helpers/Validator.php";
    require "views/ViewHandler.php"; // CHANGE FOLDER 
    require "models/BaseModel.php";
    require "models/ConnectDb.php";
    require "admin/controllers/AdminController.php";
    require "controllers/DisciplinesController.php";
    require "controllers/SchedulesController.php";
    require "controllers/UserAccountController.php";
    require "models/SchedulesModel.php";
    require "admin/models/AdminModel.php";
    require "models/DisciplinesModel.php";
    require "models/UserAccountModel.php";
    require "models/GradesModel.php";

    use App\Controllers\UserAccountController;
    use App\Controllers\AdminController;
    use App\Controllers\DisciplinesController;
    use App\Controllers\SchedulesController;
    use App\Models\SchedulesModel;
    use App\Models\DisciplinesModel;
    use App\Models\UserAccountModel;

    $userAccountController = new UserAccountController();
    $disciplinesModel = new DisciplinesModel();

    if (isset($_GET["q"])) {

        switch ($_GET["q"]) {
            
            // USERS
            case "disciplines":
                break;
            case "monespace":
                $userAccountController->connect();
                break;
            case "leclub":
                break;
            case "inscription":
                $userAccountController->subscribe();
                break;
            case 'resetPassword':
                $userAccountController->resetPassword();
                break;
            case "activateAccount":
                $userAccountController->activateAccountFromEmail();
                break;
            case "disconnect":
                $_SESSION['user_logged'] = 0;
                header("Location:./");
                break;

            // ADMIN access rendre dynamic 
            case "admin":
                $adminController = new AdminController(userModel: new UserAccountModel,viewHandler : new ViewHandler, disciplinesController: new DisciplinesController(new DisciplinesModel), adminModel: new AdminModel, schedulesController: new SchedulesController(new SchedulesModel));
                $_SESSION['admin'] = 1;
                if (isset($_GET["action"])) {
                    switch ($_GET["action"]) {
                        case 'validateStudentAccount':
                            $adminController->validateStudentAccount();
                            break;
                        case 'listSchedules':
                            $adminController->addScheduleController();
                            break;
                        case 'deleteSchedule':
                            $adminController->deleteScheduleController();
                            break;
                        case 'toValidateRegistrations':
                            $adminController->listRegistrationsController();
                            break;
                        case 'listStudents':
                            $adminController->listStudentController();
                            break;
                        case 'deleteStudent':
                            $adminController->deleteStudentController();
                            break;
                        default:
                            $adminController->homeDashboardController();
                            break;
                    }
                }else{
                    $adminController->homeDashboardController();
                }
                break;

            default:
                require 'views/404.php';
                break;
        }
        
    } else {
        require 'views/home/home.php';
        require 'views/template/template.php';
    }

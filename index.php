<?php 

    require 'models/BaseModel.php';
    require 'models/ConnectDb.php';
    require 'models/UserModel.php';


    if (isset($_GET['q'])) {
        switch ($_GET['q']) {
            case 'admin':
                if (isset($_GET['action'])) {
                    switch ($_GET['action']) {
                        case 'schedulePanel':
                            
                            break;
                        
                        default:
                            # code...
                            break;
                    }
                }
                break;
            
            default:
                echo "okok";
                break;
        }
    }else{
        echo "home";
    }


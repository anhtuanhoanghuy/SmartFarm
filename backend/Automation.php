<?php
require("JWT.php");
include ("App.php");

class Automation{
    function __construct() {
        if(isset($_POST['token']) != "") {
            require_once("AutomationModel.php");
            $kq = new AutomationModel();
            if ($_POST['function'] == "getTimer") {
                    $result = $kq -> getTimer($_POST['e_Id']);
                    echo json_encode($result);
            } else if ($_POST['function'] == "updateTimer") {
                $result = $kq -> updateTimer($_POST['e_Id'],$_POST['machine'],$_POST['timer_data'],$_POST['timer_status']);
                echo json_encode("$result");
            }
        }

    }

}

$automation = new Automation();
?>
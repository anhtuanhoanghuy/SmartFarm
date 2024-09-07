<?php
require("JWT.php");
include ("App.php");

class Device{
    function __construct() {
        if(isset($_POST['token']) != "") {
                $token = JWT::decode($_POST['token'],"30102002",true);
                require_once("DeviceModel.php");
                $kq = new DeviceModel();
                if ($_POST['function'] == "getDevice") {
                        $result = $kq -> getDevice($token->username);
                        echo json_encode($result);
                } else if ($_POST['function'] == "deleteDevice") {
                        $result = $kq -> deleteDevice($token->username, $_POST['device_eid']);
                        echo json_encode($result);
                } else if ($_POST['function'] == "addDevice") {
                        if($_POST['update']=="0") {
                                $result = $kq -> addDevice($token->username,$_POST['device_name'],$_POST['device_eid']);
                                echo json_encode($result);
                        } else if ($_POST['update']=="1") {
                                $result = $kq -> updateDevice($token->username,$_POST['device_name'],$_POST['device_eid']);
                                echo json_encode($result);  
                        }
                }

        }

}
}
$device = new Device();
?>
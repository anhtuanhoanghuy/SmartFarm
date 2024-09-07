<?php
require("JWT.php");
include ("App.php");

class Register{
    function __construct() {
        if(isset($_POST['username']) != "" && isset($_POST['password']) != "" && isset($_POST['accountname']) != "") {
            if (App::isText($username = $_POST['username']) && App::isText($password = $_POST['password']) && App::isText($password = $_POST['accountname'])) {
                $username = $_POST['username'];
                $password = md5($_POST['password']);
                $accountname = $_POST['accountname'];
                require_once("RegisterModel.php");
                $kq = new RegisterModel();
                $result = $kq -> register($username, $password, $accountname);
                if($result == 1 ) {
                   echo json_encode('register_success');
                } else if($result == 0) {
                    echo json_encode("register_failed");
                }
            } else {echo json_encode("error");} 
            
        }

}
}
$register = new Register();
?>
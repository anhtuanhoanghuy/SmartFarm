<?php
require("JWT.php");
include ("App.php");

class Login{
    function __construct() {
        if (isset($_COOKIE["token"])) {
            header("location:/SmartFarm/Homepage.php");
        } else {
            if(isset($_POST['username']) != "" && isset($_POST['password']) != "") {
                if (App::isText($username = $_POST['username']) && App::isText($password = $_POST['password'])) {
                    $username = $_POST['username'];
                    $password = md5($_POST['password']);
                    require_once("LoginModel.php");
                    $kq = new LoginModel();
                    $result = $kq -> login($username, $password);
                    if($result != 0 ) {
                        $token = array();
                        $token["username"] = $result['username'];
                        $token["accountname"] = $result['accountname'];
                        $jsonwebtoken = JWT::encode($token,"30102002");
                        setcookie('token',$jsonwebtoken,time()+3600,'/',null,true,false);
                        setcookie('accountname',$result['accountname'],time()+3600,'/',null,true,false);
                        echo json_encode("account_success");
                    } else {
                        echo json_encode("account_failed");
                    }
                } else {echo json_encode("error");} 
              
            }
        }
         
}
}
$login = new Login();
?>
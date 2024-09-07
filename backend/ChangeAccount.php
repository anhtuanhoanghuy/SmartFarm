<?php
require("JWT.php");
include ("App.php");

class ChangeAccount{
    function __construct() {
        if($_POST['token'] != "") {
            $token = JWT::decode($_POST['token'],"30102002",true);
            require_once("ChangeAccountModel.php");
            $kq = new ChangeAccountModel();
            if ($_POST['newpassword'] != "") {
                $result = $kq -> changeAll($token->username,$_POST['accountname'],md5($_POST['newpassword']),md5($_POST['oldpassword']));
                echo json_encode($result);
            } else {
                $result = $kq -> changeAccountname($token->username,$_POST['accountname'],md5($_POST['oldpassword']));
                echo json_encode($result);
            }
        } 
}
}
$changeAccount = new ChangeAccount();
?>
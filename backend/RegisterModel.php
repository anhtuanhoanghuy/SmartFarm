<?php
require_once("Database.php");
    class RegisterModel extends Database{
        //Lấy thông tin đăng nhập
        public function register($a, $b, $c){
            $sql = "SELECT * FROM account WHERE username = ?";
            $result = $this ->conn->prepare($sql);
            $result->execute([$a]);
            if ($result->rowCount() !=  0) {
                return 0;
            }
            $sql = "INSERT INTO account (username,password,accountname) VALUES (?,?,?)";
            $result = $this ->conn->prepare($sql);
            $result->execute([$a,$b,$c]);
            $sql = "SELECT * FROM account WHERE username = ?";
            $result = $this ->conn->prepare($sql);
            $result->execute([$a]);
            if ($result->rowCount() ==  1) {
                return 1;
            }         
        } 
    } 

?>
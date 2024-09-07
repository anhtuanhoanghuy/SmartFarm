<?php
require_once("Database.php");
    class LoginModel extends Database{
        //Lấy thông tin đăng nhập
        public function login($a, $b){
            $sql = "SELECT * FROM account WHERE username = ? AND password = ?";
            $result = $this ->conn->prepare($sql);
            $result->execute([$a,$b]);
            if ($result->rowCount() ==  1) {
                $user = $result->fetch(PDO::FETCH_ASSOC);
                return $user;
            } else {
                return 0;
            }           
            $conn = null;
            exit();
        } 
    } 

?>
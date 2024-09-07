<?php
require_once("Database.php");
    class ChangeAccountModel extends Database{
        public function changeAll($a, $b, $c, $d) {
            $sql = "SELECT * FROM account WHERE username = ? AND password = ?";
            $result = $this ->conn->prepare($sql);
            $result->execute([$a,$d]);
            if ($result->rowCount() ==  0) {
                return 0;
            }
            $sql = "UPDATE account SET accountname = ?, password = ? WHERE username = ?";
            $result = $this ->conn->prepare($sql);
            $result->execute([$b,$c,$a]);
            $sql = "SELECT * FROM account WHERE accountname = ? AND username = ? AND password = ?";
            $result = $this ->conn->prepare($sql);
            $result->execute([$b, $a, $c]);
            if ($result->rowCount() ==  1) {
                return 1;
            }
        } 

        public function changeAccountname($a, $b, $c) {
            $sql = "SELECT * FROM account WHERE username = ? AND password = ?";
            $result = $this ->conn->prepare($sql);
            $result->execute([$a,$c]);
            if ($result->rowCount() ==  0) {
                return 0;
            }
            $sql = "UPDATE account SET accountname = ? WHERE username = ?";
            $result = $this ->conn->prepare($sql);
            $result->execute([$b,$a]);
            $sql = "SELECT * FROM account WHERE accountname = ? AND username = ?";
            $result = $this ->conn->prepare($sql);
            $result->execute([$b, $a]);
            if ($result->rowCount() ==  1) {
                return 1;
            }
        } 
    } 

?>
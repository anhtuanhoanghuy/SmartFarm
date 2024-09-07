<?php
    if(isset($_COOKIE['token'])) {
        setcookie('token','',time()-3600,'/');
        setcookie('accountname','',time()-3600,'/');
        header("location:/SmartFarm");
    }
?>
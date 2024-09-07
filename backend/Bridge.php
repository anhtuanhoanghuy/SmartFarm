<?php
    if( isset($_COOKIE['token'])) {
        header("location:/SmartFarm/Homepage.php");
    } else {
        // require_once ("backend/App.php");
        // $myApp = new App();
        require_once("./Login.php");
    }
?>
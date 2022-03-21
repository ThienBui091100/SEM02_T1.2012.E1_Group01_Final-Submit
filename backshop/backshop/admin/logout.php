<?php
    //include_once "../connectiondb/connection.php";
    if (session_id()==='') {session_start();}
    if(isset($_SESSION["MyID"]) && $_SESSION["MyID"] != null){
        unset($_SESSION["MyID"]);
        unset($_SESSION["MyFullname"]);
        unset($_SESSION["MyName"]);
        unset($_SESSION["MyPasword"]);
        unset($_SESSION["dangnhap"]);
        unset($_SESSION["admin_id"]);
        if (isset($_COOKIE["user_login"]))
        {
            setcookie("user_login", "");
        }
        if (isset($_COOKIE["user_password"]))
        {
            setcookie("user_password", "");
        }
        //phpAlertUrl("Log out successfully","login.php");
        header("Location: index.php");
    }
?>
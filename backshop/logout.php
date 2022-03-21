<?php
    //include_once "../connectiondb/connection.php";
    if (session_id()==='') {session_start();}
    if(isset($_SESSION["dangnhap_home"]) && $_SESSION["dangnhap_home"] != null){
        unset($_SESSION["dangnhap_home"]);
        unset($_SESSION["khachhang_id"]);
        header("Location: index.php?quanly=danhmuc");
    }
?>
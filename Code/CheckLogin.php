<?php
    function CheckLogin()
    {
        header("Content-Type:text/html;charset=utf-8");  
        session_start(); 
        if( empty($_SESSION['islogin']) || empty($_SESSION['username']))  //Judge if login
        {
            echo "<script language=\"JavaScript\">alert(\"Please Login!\");</script>";
            header('refresh:0; url=index.html');
            exit;
        }
    } 
?>
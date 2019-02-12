<?php
    header("Content-Type:text/html;charset=utf-8");
    session_start();
    unset($_SESSION['islogin']);
    unset($_SESSION['username']);
    header('refresh:0; url=Admin_Login.html');
?>
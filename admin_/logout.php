<?php 
    include('../config/constant.php'); 

    session_destroy();
    
    unset($_SESSION['login']);

    header('Location: '.SITEURL.'admin_/login.php');

?> 
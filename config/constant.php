<?php
    session_start();
    define('SITEURL','http://localhost/food/');

    $server_name = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'food';

    $con = new mysqli($server_name, $username, $password, $database);
    if($con -> error){
        die('Field'. $con -> error);
    }

?>
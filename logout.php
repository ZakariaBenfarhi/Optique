<?php

require_once 'DB.php';

session_start();
if(isset($_SESSION["email"])){
    unset($_SESSION["email"]);
}
if(isset($_SESSION["role"])){
    unset($_SESSION["role"]);
}

session_destroy();
header("location:OptiqueShop.php");
?>
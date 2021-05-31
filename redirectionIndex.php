<?php
session_start();
if(!(isset($_SESSION['email'])) || (!(isset($_SESSION['role'])))){
    header("location:OptiqueShop.php");
}
?>
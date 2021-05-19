<?php

require_once 'DB.php';

$comm = $_GET["ref"];
$etat = $_GET["st"];

if($etat == "" || $etat == "0"){
    $query = "update commande set etat_commande = 1 where ref_commande = " . $comm;
}
else {
    $query = "update commande set etat_commande = 0 where ref_commande = " . $comm;
}
mysqli_query($con, $query);
header("location:Commandes.php");


?>
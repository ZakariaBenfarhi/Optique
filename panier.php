<?php
require_once 'DB.php';

$produit = $_GET["produit"];
$client = $_GET["client"];

$que_ref_client = "select ref_client from users where email = '" . $client . "'";
$rs_ref_client = mysqli_query($con, $que_ref_client);
if($et_ref_client = mysqli_fetch_assoc($rs_ref_client)){
    $ref_client = $et_ref_client["ref_client"];
}

$que = "select p.status as st from panier p, users u where p.ref_user = u.ref_client and p.ref_produit = " . $produit . " and u.email = '" . $client . "'";
if($rs = mysqli_query($con, $que)){
    if(mysqli_num_rows($rs) == 0){
        $query = "insert into panier (ref_produit, ref_user, status) values (" . $produit . ", " . $ref_client . ", 1)";
        mysqli_query($con, $query);
    }
    else {
        if($et_que = mysqli_fetch_assoc($rs)){
            $st = $et_que["st"];
        }
        if($st == 1){
            $query = "update panier set status = 0 where ref_produit =" . $produit . " and ref_user =" . $ref_client;
            mysqli_query($con, $query);
        }
        else {
            $query = "update panier set status = 1 where ref_produit =" . $produit . " and ref_user =" . $ref_client;
            mysqli_query($con, $query);
        }
    }
    
    header("location:OptiqueShop.php");
}

?> 
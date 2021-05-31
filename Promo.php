<?php
//if(!empty($_SESSION["role"]) && $_SESSION["role"] == "Opticien"){
    require_once 'redirectionIndex.php';
    require_once 'out.php';
    require_once 'DB.php';
    //require_once 'headerAdmin.php';

    if(isset($_POST["conf"])){
        $date = $_POST["debut"];
        $prod = $_POST["prod"];
        $duree = $_POST["duree"];
        $remise = $_POST["rem"];
        
        $query_promo = "insert into promotion (ref_produit, remise, date_debut, duree) values (" . $prod . ", " . $remise . ", '" . $date . "', " . $duree . ")";
        if(mysqli_query($con, $query_promo)){
            $que_up_promo = "update promotion set prix_promo = (select prix_vente - prix_vente * " . $remise . " / 100 from produit where ref_Produit = " . $prod . "), date_fin = date_add(date_debut, INTERVAL ". $duree ." day) where ref_promo = (select ref_promo from promotion where ref_produit = " . $prod . " and remise = " . $remise . " and duree = " . $duree . " and date_debut = '" . $date . "')";
            if(mysqli_query($con, $que_up_promo)){
                echo '';
            }
        }
    }
?>


		
	



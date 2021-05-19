<?php

require_once 'DB.php';

$login = $_POST["email"];
$pwd = $_POST["pwd"];

if(!empty($login) && !empty($pwd)){
    $query = "select role from Users where email = '" . $login . "' and pwd = '" . $pwd . "' and status = 1";
    if($rs = mysqli_query($con, $query)){
        if(mysqli_num_rows($rs) > 0){
            while ($et = mysqli_fetch_assoc($rs)){
                $role = $et["role"];
            }
            if($role == "Opticien"){
                session_start();
                $_SESSION["email"] = $login;
                $_SESSION["role"] = $role;
               
                header("location:Produits.php");
            }
            elseif ($role == "Client"){
                session_start();
                $_SESSION["email"] = $login;
                $_SESSION["role"] = $role;
                header("location:OptiqueShop.php");
            }
            elseif($role == "Fournisseur") {
                session_start();
                $_SESSION["email"] = $login;
                $_SESSION["role"] = $role;
            }
        }
        else {
            header("location:OptiqueShop.php");
        }
    }
}

?> 

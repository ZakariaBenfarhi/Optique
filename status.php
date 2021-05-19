<?php
//if(!empty($_SESSION["role"]) && $_SESSION["role"] == "Opticien"){

    require_once 'DB.php';
    
    $ref = $_GET["ref"];
    $status = $_GET["status"];
    
    if($status == 1){
        $query = "update users set status = 0 where ref_client = " . $ref;
    }
    else {
        $query = "update users set status = 1 where ref_client = " . $ref;
    }
    mysqli_query($con, $query);
    
    header("location:Profiles.php");

// } else {
//     header("location:Error404.php");
// }
?>
<?php
require_once 'DB.php';
$email = $_SESSION['email'];
$query = "select status from users where email = '" . $email . "'";
$rs = mysqli_query($con, $query);
while($et = mysqli_fetch_assoc($rs)){
    if($et['status'] == 0){
        require_once 'redirectionIndex.php';
        require_once 'logout.php';
    }
    else {
        
    }
}

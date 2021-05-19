<?php
//if(!empty($_SESSION["role"]) && $_SESSION["role"] == "Opticien"){
    
    require_once 'DB.php';
    require_once 'headerAdmin.php';
    
    if(isset($_POST["Enregistrer"])){
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $sexe = $_POST["sexe"];
        $email = $_POST["email"];
        $tele = $_POST["tele"];
        $ville = $_POST["ville"];
        $adr = $_POST["adr"];
        $couv_medi = $_POST["couv_medi"];
        $role = $_POST["role"];
        
        $nom_rep = str_replace("'", "\'", $nom);
        $prenom_rep = str_replace("'", "\'", $prenom);
        $email_rep = str_replace("'", "\'", $email);
        $ville_rep = str_replace("'", "\'", $ville);
        $adr_rep = str_replace("'", "\'", $adr);
        $pwd = $nom_rep . "@" . $prenom_rep;
        
        $que_email = "select count(email) as mail from users where email = '" . $email . "'";
        $rs_email = mysqli_query($con, $que_email);
        $et_email = mysqli_fetch_assoc($rs_email);
        if($et_email["mail"] == 0){
            if(empty($_FILES['img']['name'])){
                $img = "compte.ico";
            }
            else {
                $img = $_FILES['img']['name'];
                $img_tmp = $_FILES['img']['tmp_name'];
                move_uploaded_file($img_tmp, 'img/' . $img);
            }
            
            $query = "insert into users (nom, prenom, sexe, email, telephone, ville, adresse, couv_medi, role, pwd, img) values ('". $nom_rep ."','" . $prenom_rep . "', '" . $sexe . "', '" . $email_rep . "', '" . $tele . "', '" . $ville_rep . "', '" . $adr_rep . "', '" . $couv_medi . "', '" . $role . "', '" . $pwd ."', '" . $img . "')";
            if(mysqli_query($con, $query)){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style="width:100%; height:200px; text-align:center; font-size:25px;">
                        La Creation est Enregitree avec Success.<br><br>
                        <div class="container col-md-4 col-md-offset-4"><a href="Profiles.php" class="btn btn-outline-info form-control">Valider </a></div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
                $email_rep = NULL;
                
            }
        }
        else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="width:100%; height:120px; text-align:center; font-size:25px;">
                    E-mail est deja Utilise !!<br>
                    <div class="container col-md-4 col-md-offset-4" style="padding-top:15px;"><a href="Profiles.php" class="btn btn-outline-info form-control">Ressayer Une Autre Fois !</a></div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
        }
    }

// } else {
//     header("location:Error404.php");
// } 
?>
    	
    	
    	
    	
    	
    	
<?php
require_once 'DB.php';
require_once 'OptiqueShop.php';

if(isset($_POST["Connecter"])){
    $nom = $_POST["nom"];
    $pre = $_POST["prenom"];
    $sexe = $_POST["sexe"];
    $email = $_POST["email"];
    $tele = $_POST["tele"];
    $adr = $_POST["adr"];
    $ville = $_POST["ville"];
    $couv_medi = $_POST["couv_medi"];
    $pwd = $_POST["pwd"];
    
    $nom_rep = str_replace("'", "\'", $nom);
    $pre_rep = str_replace("'", "\'", $pre);
    $email_rep = str_replace("'", "\'", $email);
    $adr_rep = str_replace("'", "\'", $adr);
    $ville_rep = str_replace("'", "\'", $ville);
    $pwd_rep = str_replace("'", "\'", $pwd);
    
    
    if(!empty($email_rep)){
        $que_email = "select email from users where email = '" . $email_rep . "'";
        $rs_email = mysqli_query($con, $que_email);
        if(mysqli_num_rows($rs_email) != 0){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="text-align:center; font-size:25px;">
                      Cette Adresse E-mail deja Utilise !
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                      </button>
                  </div>';
        } else {
            if(!empty($nom_rep) && !empty($pre_rep) && !empty($adr_rep) && !empty($ville_rep) && !empty($pwd_rep)){
                
                if(empty($_FILES["img"]["name"])){
                    $img = "compte.ico";
                }
                else {
                    $img = $_FILES["img"]["name"];
                    $img_tmp = $_FILES["img"]["tmp_name"];
                    move_uploaded_file($img_tmp, 'img/' . $img);
                }
                $que_client = "insert into users (nom, prenom, sexe, email, telephone, adresse, ville, img, couv_medi, role, pwd) values('" . $nom_rep . "', '" . $pre_rep . "', '" . $sexe . "', '" . $email_rep . "', '" . $tele . "', '" . $adr_rep . "', '" . $ville_rep . "', '" . $img . "', '" . $couv_medi . "', 'Client', '" . $pwd_rep . "')" ;              
                if(mysqli_query($con, $que_client)){
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style="text-align:center; font-size:25px;">
                              Merci Chere Client ' . $nom_rep . ' pour Votre Inscription
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                              </button>
                          </div>';
                }
                else {
                    echo 'Error d\'Insertion';
                }
            }
        }
    }
} 
?>
		











<?php

//if(!empty($_SESSION["role"]) && $_SESSION["role"] == "Opticien"){
        require_once 'redirectionIndex.php';
        require_once 'out.php';
        require_once 'DB.php';
        
        if(isset($_POST["Enregistrer"])){
            
            $cat = $_POST["cat"];
            $qte = $_POST["qte"];
            $prix = $_POST["prix"];
            $pour = $_POST["pour"];
            $type = $_POST["type"];
            $larg = $_POST["largeur"];
            $desc = $_POST["desc"];
            $titre = $_POST["titre"];
            
            $titre_rep = str_replace("'", "\'", $titre);
            $description = str_replace("'", "\'", $desc);
            
            if(!empty($cat)  && !empty($qte) && !empty($prix) && !empty($pour) && !empty($type) && !empty($larg) && !empty($desc)){
                $query = "insert into produit (ref_cat, titre, qte_stocke, prix_vente, pour, type, largeur, descrip) values (" . $cat . ",'" . $titre_rep . "'," . $qte . ", " . $prix . ", '" . $pour . "', '" . $type . "', " . $larg . ", '" . $description . "')";
                if(mysqli_query($con, $query)){
                    $que_prod = "select * from produit where ref_cat = " . $cat . " and titre = '". $titre_rep ."' and qte_stocke = " . $qte . " and prix_vente = " . $prix . " and pour = '" . $pour . "' and type = '" . $type . "' and largeur = " . $larg . " and descrip = '" . $description . "'";
                    if($rs_prod = mysqli_query($con, $que_prod)){
                        while ($et_prod = mysqli_fetch_assoc($rs_prod)){
                            $prod_id = $et_prod["ref_Produit"];
                        }
                        if(!empty($prod_id)){
                            if(!empty($_FILES['photo']['name'])){
                                $fileCount = count($_FILES['photo']['name']);
                                for ($i= 0; $i < $fileCount; $i++){
                                    $fileName = $_FILES['photo']['name'][$i];
                                    $file_tmp = $_FILES['photo']['tmp_name'][$i];
                                    move_uploaded_file($file_tmp, 'img/' . $fileName);
                                    $que_pics = "insert into photo (ref_produit, photo) values (" . $prod_id . ", '" . $fileName . "')";
                                    mysqli_query($con, $que_pics);
                                }
                            }
                        }
                        
                    }
                    header("Location:Produits.php");
                }
            }
        }

//  } else { 
// 	 header("location:Error404.php");
//  } 
?> 


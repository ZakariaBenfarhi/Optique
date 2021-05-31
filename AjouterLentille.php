<?php
//if(!empty($_SESSION["role"]) && $_SESSION["role"] == "Opticien"){
    require_once 'redirectionIndex.php';
    require_once 'out.php';
    require_once 'DB.php';
    require_once 'headerAdmin.php';
    
    
    
    
    
    if(isset($_POST["Enregistrer"])){
        $cat = $_POST["cat"];
        $titre = $_POST["titre"];
        $type = $_POST["type"];
        $qte = $_POST["qte"];
        $prix = $_POST["prix"];
        $desc = $_POST["desc"];
        $ref = $_POST["ref"];
        
        $titre_rep = str_replace("'", "\'", $titre);
        $description = str_replace("'", "\'", $desc);
        $ref_rep = str_replace("'", "\'", $ref);
        
        if(!empty($cat) && !empty($titre_rep) && !empty($type) && !empty($qte) && !empty($prix) && !empty($desc) && !empty($ref)){
            $query = "insert into produit (ref_cat, pour, titre, qte_stocke, prix_vente, ref_lentille, type_lentille, descrip) values (". $cat . ", 'Femme', '". $titre_rep ."',". $qte .", ". $prix .", '". $ref_rep . "', '" . $type . "', '" . $description . "')";
            if(mysqli_query($con, $query)){
                $que_prod = "select * from produit where ref_cat = " . $cat . " and pour = 'Femme' and titre = '" . $titre_rep . "' and qte_stocke = " . $qte . " and prix_vente = " . $prix . " and ref_lentille = '" . $ref_rep . "' and type_lentille = '" . $type . "' and descrip = '" . $description . "' limit 1";
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
             
        
?> 
		<div class="container col-md-6 col-md-offset-3" style="top: 10%">
			 
		</div><br><br><br>
	</body><br><br><br><br><br>
</html>


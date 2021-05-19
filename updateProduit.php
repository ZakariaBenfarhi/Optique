<?php

//if(!empty($_SESSION["role"]) && $_SESSION["role"] == "Opticien"){

    require_once 'DB.php';
    require_once 'headerAdmin.php';
    
    $ref_prod = $_GET["ref"];
    $query = "select * from produit where ref_Produit = $ref_prod";
    $rs = mysqli_query($con, $query);
    
    $c = 0;
    
    if(isset($_POST["Enregistrer"])){
        $cat = $_POST["cat"];
        $qte = $_POST["qte"];
        $prix = $_POST["prix"];
        $pour = $_POST["pour"];
        $type = $_POST["type"];
        $larg = $_POST["largeur"];
        $desc = $_POST["desc"];
        $ref = $_POST["ref_lent"];
        $type_lent = $_POST["type_lent"];
        $titre = $_POST["titre"];
        
        $desc_rep = str_replace("'", "\'", $desc);
        $ref_rep = str_replace("'", "\'", $ref);
        $type_lent_rep = str_replace("'", "\'", $type_lent);
        $titre_rep = str_replace("'", "\'", $titre);
        
        if(!empty($cat) && !empty($titre) && !empty($qte) && !empty($prix) && !empty($pour) && !empty($type) && !empty($larg) && !empty($desc)){
            $update = "update produit set ref_cat = " . $cat . ", titre = '" . $titre_rep . "', qte_stocke = " . $qte . ", prix_vente = " . $prix . ", pour = '" . $pour ."', type = '". $type ."', largeur = " . $larg . ", descrip = '" . $desc . "' where ref_Produit = " . $ref_prod;          
            if(mysqli_query($con, $update)){
                $c = 1;
            }
        }
        elseif (!empty($cat) && !empty($titre) && !empty($qte) && !empty($prix) && !empty($type_lent_rep) && !empty($desc_rep) && !empty($ref_rep)){
            $update = "update produit set ref_cat = " . $cat . ", titre = '" . $titre_rep . "', qte_stocke = " . $qte . ", prix_vente = " . $prix . ", type_lentille = '" . $type_lent_rep ."',  = '". $type ."', descrip = '" . $desc_rep . "', ref_lentille = '" . $ref_rep . "' where ref_Produit = " . $ref_prod;
            if(mysqli_query($con, $update)){
                $c = 1;
            }
        }
        if($c == 1){
            header("Location:Produits.php");
        }
    }

?> 

	<?php while ($et = mysqli_fetch_assoc($rs)){ ?>
		<div class="container col-md-6 col-md-offset-3" style="top: 10%">
			<div class="card">
				<div class="card-header">Modifier Le Produit :</div><br>
				<div class="card-body">
					<form action="" method="post">
    					<div class="group-form">
    						<label class="label-form">Categorie :</label>
    						<select class="form-control" name="cat">
    							<?php if($et["ref_cat"] == 1){  ?>
    								<option value="1" selected="selected">Lunette de Vue</option>
    								<option value="2">Lunette de Soleil</option>
    								<option value="3">Les Lentilles</option>
    							<?php } elseif ($et["ref_cat"] == 2){ ?>
    								<option value="1">Lunette de Vue</option>
    								<option value="2" selected="selected">Lunette de Soleil</option>
    								<option value="3">Les Lentilles</option>
    							<?php } elseif ($et["ref_cat"] == 3){ ?>
    								<option value="1">Lunette de Vue</option>
    								<option value="2">Lunette de Soleil</option>
    								<option value="3" selected="selected">Les Lentilles</option>
    							<?php } ?>
    						</select>
    					</div><br>
    					<div class="group-form">
    						<label class="label-form">Nom d'Article :</label>
    						<input type="text" class="form-control" name="titre" maxlength="50" value="<?php echo $et["titre"] ?>" required="required">
    					</div><br>
    					<div class="row">
        					<div class="col-md-6">
        						<label class="label-form">Quantite Stocke :</label>
        						<input type="number" class="form-control" name="qte" min="1" value="<?php echo $et["qte_stocke"] ?>" required="required">
        					</div>
        					<div class="col-md-6">
        						<label class="label-form">Prix du Vente :</label>
        						<input type="number" class="form-control" name="prix" min="1" value="<?php echo $et["prix_vente"] ?>" required="required">
        					</div>
        				</div><br>
        				<?php if(!empty($et["type"]) && !empty($et["largeur"])){ ?>
        				<div class="group-form">
        						<label class="label-form">Reserve Pour :</label>
        						<select class="form-control" name="pour">
        							<?php if($et["pour"] == "Enfant"){ ?>
        							<option value="Enfant" selected="selected">Enfant</option> 
        							<option value="Homme">Homme</option> 
        							<option value="Femme">Femme</option>
        							<?php } elseif ($et["pour"] == "Homme"){ ?> 
        							<option value="Enfant">Enfant</option> 
        							<option value="Homme" selected="selected">Homme</option> 
        							<option value="Femme">Femme</option>
        							<?php } else{ ?>
        							<option value="Enfant">Enfant</option> 
        							<option value="Homme">Homme</option> 
        							<option value="Femme" selected="selected">Femme</option>
        							<?php } ?>
        						</select>
        				</div><br>
        				<?php } ?>
        				<?php if(!empty($et["type"]) && !empty($et["largeur"])){ ?>
        				<div class="row">
        					<div class="col-md-6">
        						<label class="label-form">Type du Produit :</label>
        						<select class="form-control" name="type">
        							<?php if($et["type"] == "Unifocaux"){ ?>
        							<option value="Unifocaux" selected="selected">Unifocaux</option> 
        							<option value="Progressifs">Progressifs</option> 
        							<option value="Sans Correction">Sans Correction</option> 
        							<?php } elseif ($et["type"] == "Progressifs"){ ?>
        							<option value="Unifocaux">Unifocaux</option> 
        							<option value="Progressifs" selected="selected">Progressifs</option> 
        							<option value="Sans Correction">Sans Correction</option>
        							<?php } else { ?>
        							<option value="Unifocaux">Unifocaux</option> 
        							<option value="Progressifs">Progressifs</option> 
        							<option value="Sans Correction" selected="selected">Sans Correction</option>
        							<?php } ?>
        						</select>
        					</div>
        					<div class="col-md-6">
    							<label class="label-form">La Largeur du Lunette :</label>
    							<input type="number" class="form-control" name="largeur" value="<?php echo $et["largeur"] ?>" required="required">
    						</div>
        				</div><br>
						<?php } ?>
    					<?php if(!empty($et["ref_lentille"]) && !empty($et["type_lentille"])){ ?>
        					<div class="group-form">
        						<label class="label-form">Reference du Lentille :</label>
        						<input type="text" class="form-control" name="ref_lent" value="<?php echo $et["ref_lentille"] ?>" required="required">
        					</div><br>
        					<div class="group-form">
        						<label class="label-form">Type du Lentille :</label>
        						
        						<select class="form-control" name="type_lent">
        							<?php if($et["type_lentille"] == "Cosmetique"){ ?>
                            			<option value="Cosmetique" selected="selected">Cosmetique</option> 
                            			<option value="Correction">Correction</option> 
                            		<?php } else{ ?>
                            			<option value="Cosmetique">Cosmetique</option> 
                            			<option value="Correction" selected="selected">Correction</option>
                            		<?php } ?>
                          		</select>
        					</div><br>
        				<?php } ?>
    					<div class="group-form">
    						<label class="label-form">Description :</label>
    						<textarea class="form-control" name="desc" rows="3" cols="12" maxlength="200" required="required"><?php echo $et["descrip"] ?></textarea>
    					</div><br> 
    					<div class="group-form">
    						<input type="submit" name="Enregistrer" class="form-control btn btn-primary" value="Enregistrer">
    					</div>
					</form>
				</div>
			</div> 
		</div><br><br><br>
		<?php } ?>
	</body><br><br><br><br><br>
</html>





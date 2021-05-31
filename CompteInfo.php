<?php

//if(!empty($_SESSION["role"]) && $_SESSION["role"]== "Opicien"){
    require_once 'redirectionIndex.php';
    require_once 'out.php';
    require_once 'DB.php';
    require_once 'headerAdmin.php';
    
    $ref = $_GET["ref"];
    
    $query = "select * from users where ref_client = " . $ref;
    $rs = mysqli_query($con, $query);
    
    
    if(isset($_POST["Enregistrer"])){
        $nom = $_POST["nom"];
        $pre = $_POST["prenom"];
        $sexe = $_POST["sexe"];
        $tele = $_POST["tele"];
        $ville = $_POST["ville"];
        $adr = $_POST["adr"];
        $couv_medi = $_POST["couv_medi"];
        $role = $_POST["role"];
        
        $nom_rep = str_replace("'", "\'", $nom);
        $pre_rep = str_replace("'", "\'", $pre);
        $ville_rep = str_replace("'", "\'", $ville);
        $adr_rep = str_replace("'", "\'", $adr);
     
        if(!empty($nom_rep) && !empty($pre_rep) && !empty($sexe) && !empty($tele) && !empty($ville_rep) && !empty($adr_rep) && !empty($couv_medi) && !empty($role)){
            $que_up = "update users set nom = '$nom_rep', prenom = '$pre_rep', sexe = '$sexe', telephone = '$tele', adresse = '$adr_rep', ville = '$ville_rep', couv_medi = '$couv_medi', role = '$role' where ref_client = $ref";          
            if(mysqli_query($con, $que_up)){
                if(!empty($_FILES["img"]["name"])){
                    $img = $_FILES["img"]["name"];
                    $img_tmp = $_FILES["img"]["tmp_name"];
                    move_uploaded_file($img_tmp, 'img/' . $img);
                    
                    $que_up_img = "update users set img = '" . $img . "' where ref_client = " . $ref;
                    mysqli_query($con, $que_up_img);
                }
            }
        }
    }

?> 
		<div class="container col-md-6 col-md-offset-3" style="padding-top: 5%;">
    		<div class="card">
    			<?php while ($et = mysqli_fetch_assoc($rs)){ ?>
    			<div class="card-header">MAJ du Compte sous la Reference <?php echo $et["ref_client"] ?></div>
    			<div class="card-body">
    				<form action="" method="post" enctype="multipart/form-data">
    					<div class="row">
            				<div class="col-md-4">
            					<label class="label-form">Nom :</label>
            					<input type="text" name="nom" class="form-control" maxlength="20" required="required" value="<?php echo $et["nom"] ?>">
            				</div><br>
            				<div class="col-md-4">
            					<label class="label-form">Prenom :</label>
            					<input type="text" class="form-control" name="prenom" maxlength="20" required="required" value="<?php echo $et["prenom"] ?>">
            				</div><br>
            				<div class="col-md-4">
            					<label class="label-form">Sexe :</label>
            					<select name="sexe" class="form-control">
            						<?php if($et["sexe"] == "Femme"){ ?>
                						<option selected="selected" value="Femme">Femme</option> 
                						<option value="Homme">Homme</option>
            						<?php } else { ?> 
            							<option value="Femme">Femme</option> 
            							<option selected="selected" value="Homme">Homme</option>
            						<?php } ?>
            					</select> 
            				</div><br>
            			</div><br>
       					<div class="row">
            				<div class="col-md-6">
            					<label class="label-form">E-mail *</label>
            					<input type="email" disabled="disabled" name="email" class="form-control" maxlength="50" required="required" value="<?php echo $et["email"] ?>">
            				</div><br>
            				<div class="col-md-6">
            					<label class="label-form">Telephone	 :</label>
            					<input type="text" class="form-control" name="tele" maxlength="10" required="required" value="<?php echo $et["telephone"] ?>">
            				</div><br>
            			</div><br>
       					<div class="row">
            				<div class="col-md-6">
            					<label class="label-form">Ville :</label>
            					<input type="text" name="ville" class="form-control" maxlength="20" required="required" value="<?php echo $et["ville"] ?>">
            				</div><br>
            				<div class="col-md-6">
            					<label class="label-form">Adresse :</label>
            					<textarea rows="1" class="form-control" name="adr" maxlength="100" required="required"><?php echo $et["adresse"] ?></textarea>
            				</div><br>
            			</div><br>
       					<div class="row">
            				<div class="col-md-6">
            					<label class="label-form">Couverture Medicale :</label>
            					<select name="couv_medi" class="form-control">
            						<?php if($et["couv_medi"] == "CNOPS"){ ?>
                						<option value="CNOPS" selected="selected">CNOPS</option> 
                						<option value="CNSS">CNSS</option> 
                						<option value="RAMID">RAMID</option> 
                						<option value="Neant">Neant</option> 
            						<?php }elseif($et["couv_medi"] == "CNSS"){ ?>
            							<option value="CNOPS">CNOPS</option> 
                						<option value="CNSS" selected="selected">CNSS</option> 
                						<option value="RAMID">RAMID</option> 
                						<option value="Neant">Neant</option> 
            						<?php }elseif($et["couv_medi"] == "RAMID"){ ?>
            							<option value="CNOPS">CNOPS</option> 
                						<option value="CNSS">CNSS</option> 
                						<option value="RAMID" selected="selected">RAMID</option> 
                						<option value="Neant">Neant</option> 
            						<?php }else{ ?>
            							<option value="CNOPS">CNOPS</option> 
                						<option value="CNSS">CNSS</option> 
                						<option value="RAMID">RAMID</option> 
                						<option value="Neant" selected="selected">Neant</option> 
            						<?php } ?>
            					</select> 
            				</div><br>
            				<div class="col-md-6">
            					<label class="label-form">Role :</label>
            					<select name="role" class="form-control">
            						<?php if($et["role"] == "Client"){ ?>
                						<option value="Client" selected="selected"  >Client</option> 
                						<option value="Fournisseur">Fournisseur</option> 
                						<option value="Opticien">Opticien</option> 
            						<?php }elseif ($et["role"] == "Opticien") { ?>
            							<option value="Client">Client</option> 
                						<option value="Fournisseur">Fournisseur</option> 
                						<option value="Opticien" selected="selected">Opticien</option> 
            						<?php }else{ ?>
            							<option value="Client">Client</option> 
                						<option value="Fournisseur" selected="selected">Fournisseur</option> 
                						<option value="Opticien">Opticien</option> 
            						<?php } ?>
            					</select>
            				</div><br>
            			</div><br><br><br>
            			<div class="row">
            				<div class="col-md-4" style="text-align: center;">
            					<img src="<?php echo 'img/' . $et["img"] ?>" width="100">
            				</div>
            				<div class="col-md-8" style="text-align: center;">
            					<input type="file" name="img" class="form-control">
            				</div>
            			</div><br><br>
       					<div class="">
       						<div class="container col-md-6 col-md-offset-3">
       							<input type="submit" value="Enregistrer" name="Enregistrer" class="btn btn-primary form-control">
       						</div>
       					</div>
        			</form>
    			</div>
    			<?php } ?>
    		</div>
		</div>
		
	</body> 
</html>


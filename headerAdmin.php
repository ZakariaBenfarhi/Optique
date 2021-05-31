<?php
    
    require_once 'DB.php';
    
    //if(!empty($_SESSION["role"]) && $_SESSION["role"] == "Opticien"){
        
        //session_start();
        if(!empty($_SESSION["role"]) && !empty($_SESSION["email"])){
            $role = $_SESSION["role"];
            $login = $_SESSION["email"];
            $que_nom_pre = "select nom, prenom from users where email = '" . $login . "' and role = '" . $role . "'";
            $rs_nom_pre = mysqli_query($con, $que_nom_pre);
            $et_nom_pre = mysqli_fetch_assoc($rs_nom_pre);
            $n = $et_nom_pre["nom"];
            $p = $et_nom_pre["prenom"];
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style="width:100%; height:70px; text-align:center; font-size:25px;">
                        Bienvenue Notre Chere Opticien <strong>' . $n . ' ' . $p . '</strong> !<br><br>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
              </div>';
            
            $que_para = "select * from users where email = '" . $_SESSION["email"] . "' and role = '" . $_SESSION["role"] . "'";
            $rs_para = mysqli_query($con, $que_para);
            
            $que_paraa_img = "select img from users where email = '" . $_SESSION["email"] . "' and role = '" . $_SESSION["role"] . "'";
            $rs_paraa_img = mysqli_query($con, $que_paraa_img);
            
            if($_SESSION["role"] != "Opticien"){
                http_response_code(404);
            }
        }
        
        
        $load_cat = "select ref_cat, descrip_cat FROM categorie where descrip_cat like '%lunette%'";
        $rs_load_cat = mysqli_query($con, $load_cat);
        
        $load_cat_lent = "select ref_cat, descrip_cat FROM categorie where descrip_cat like '%lentille%'";
        $rs_load_cat_lent = mysqli_query($con, $load_cat_lent);
      
  
    
?>
<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<style type="text/css">
		  .notify:hover{
    	       background: silver;
    	       color: black ;
    	   }
		</style>
	</head>
	<body>
    	<div class="navbar navbar-expand-sm navbar-light bg-light">
			<marquee width="350px" height="70px"><a class="navbar-brand active" style="width: 350px;" href="Produits.php"><span><img src="./assets/yeux.jpg" width="50px"></span><span style="color: threedshadow; font-size : 22px; font-weight: bold; font-style: italic; font-family: fantasy;">Optique Shop</span><span style="font-size: 17px; color: blue;"><br><sub style="text-align: center;">Nous Sommes Pas Les Seuls, Mais Nous Sommes Les Meilleurs</sub></span></a></marquee>
			<button class="navbar-toggler" data-toggle="collapse" data-target="#nav"> 
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="nav">
    			<ul class="navbar-nav ml-auto">
    				<li class="dropdown nav-item menuu" style="padding-right: 50px; padding-left: 100px;">
    					<a href="#" style="width: 180px" class="nav-link dropdown-toggle" role="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    						<span><img src="./assets/produit.ico" width="25px"><?php echo "&nbsp; &nbsp;" ?></span>Produits
    					</a>
    					<div class="dropdown-menu navbar-light bg-light" aria-labelledby="dropdownMenuButton">
    						<a class="dropdown-item notify" href="Produits.php" style="">Consulter Les Produits</a>
    						<div class="dropdown-divider"></div>
    						<button type="button" class="dropdown-item notify" data-toggle="modal" data-target="#exampleModal1">Ajouter Lunette</button>	
    						<div class="dropdown-divider"></div>
    						<button type="button" class="dropdown-item notify" data-toggle="modal" data-target="#exampleModal2" style="">Ajouter Lentille</button>
    						<div class="dropdown-divider"></div>
    						<button type="button" class="dropdown-item notify" data-toggle="modal" data-target="#exampleModal23">Postuler des Promotions</button>
    					</div>
    				</li>
    				
    				<li class="dropdown nav-item menuu" style="padding-right: 50px">
    					<a href="#" style="width: 180px" class="nav-link dropdown-toggle" role="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    						<span><img src="./assets/fournisseur.ico" width="15px"><?php echo "&nbsp; &nbsp;" ?></span>Fournisseurs
    					</a>
    					<div class="dropdown-menu navbar-light bg-light" aria-labelledby="dropdownMenuButton">
    						<a class="dropdown-item notify" href="Fournisseurs.php" style="">Consulter Les Fournisseurs</a>
    					</div>
    				</li>
    				
    				<li class="dropdown nav-item menuu" style="padding-right: 50px">
    					<a href="#" style="width: 180px" class="nav-link dropdown-toggle" role="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
    						<span><img src="./assets/transaction.ico" width="25px"><?php echo "&nbsp; &nbsp;" ?></span>Transactions
    					</a>
    					<div class="dropdown-menu navbar-light bg-light" aria-labelledby="dropdownMenuButton">
    						<a class="dropdown-item notify" href="Achat.php" style="">Achat</a>
    						<div class="dropdown-divider"></div>
    						<a class="dropdown-item notify" href="Vente.php" style="">Vente</a>
    						<div class="dropdown-divider"></div>
    						<a class="dropdown-item notify" href="Commandes.php" style="">Les Commandes</a>
    					</div>
    				</li> 
    				<li class="dropdown nav-item menuu" style="padding-right: 50px"> 
    					<a href="#" style="width: 180px" class="nav-link dropdown-toggle" role="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    						<span>
    							<?php while ($et_paraa_img = mysqli_fetch_assoc($rs_paraa_img)){ ?>
        							<?php if($et_paraa_img["img"] == "compte.ico"){ ?>
        								<img src="./assets/compte.ico" width="25px">
        							<?php } else { ?>
        								<img src="<?php echo 'img/' . $et_paraa_img["img"] ?>" width="25px">
        							<?php } ?>
        						<?php } ?>
    							<?php echo "&nbsp; &nbsp;" ?>
    						</span>Comptes
    					</a>
    					<div class="dropdown-menu navbar-light bg-light" aria-labelledby="dropdownMenuButton">
    						<a class="dropdown-item notify" href="Profiles.php" style="">Consulter les Profiles</a>
    						<div class="dropdown-divider"></div>
    						<a class="dropdown-item notify" href="Clients.php" style="">Clients</a>
    						<div class="dropdown-divider"></div>
    						<button type="button" class="dropdown-item notify" data-toggle="modal" data-target="#exampleModal4" style="">Creation d'un Compte</button>
    					</div>
    				</li>
        			
        			<li class="dropdown nav-item menuu" style="padding-right: 30px">
        				<a href="#" style="width: 180px" class="nav-link dropdown-toggle" role="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        					<span><img src="./assets/setting.ico" width="25px"><?php echo "&nbsp; &nbsp;" ?></span>Mon Compte
        				</a>
        				<div class="dropdown-menu navbar-light bg-light" aria-labelledby="dropdownMenuButton">
    						<a class="dropdown-item notify" href="#" style="">Dashboard</a>
    						<div class="dropdown-divider"></div>
    						<button type="button" class="dropdown-item notify" data-toggle="modal" data-target="#exampleModal7" style="">Settings</button>
    						<div class="dropdown-divider"></div>
    						<a class="dropdown-item notify" href="logout.php" style="">Log Out [ <?php echo ((isset($_SESSION['email']))?($_SESSION['email']):"") ?> ]</a>
    					</div>
        			</li>	
    			</ul>
    			
    			<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                	<div class="modal-dialog">
                     	<div class="modal-content">
                        	<div class="modal-header" style="text-align: center;">
                             	<h5 class="modal-title" id="exampleModalLabel">Ajouter des Lunettes </h5>
                               	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 	<span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="AjouterProduit.php" method="post" enctype="multipart/form-data">
                             	<div class="modal-body">
                                    <div class="group-form">
                						<label class="label-form">Categorie :</label>
                						<select class="form-control" name="cat" id="categorie">
                							<?php while ($et_load_cat = mysqli_fetch_assoc($rs_load_cat)){ ?>
                								<option value="<?php echo $et_load_cat["ref_cat"] ?>"><?php echo $et_load_cat["descrip_cat"] ?></option>
                							<?php } ?>
                						</select>
    								</div><br>
                					<div class="group-form">
                						<label class="label-form">Nom d'Article :</label>
                						<input type="text" class="form-control" name="titre" maxlength="50" required="required">
                					</div><br>
                					<div class="row">
                						<div class="col-md-6">
                							<label class="label-form">Quantite Stocke :</label>
                							<input type="number" class="form-control" name="qte" min="1" required="required">
                						</div>
                						<div class="col-md-6">
                							<label class="label-form">Prix du Vente :</label>
                							<input type="number" class="form-control" name="prix" min="1" required="required">
                						</div>
                					</div><br>
                					<div class="row">
                						<div class="col-md-6">
                							<label class="label-form">Reserve Pour :</label>
                							<select class="form-control" name="pour">
                								<option value="Enfant">Enfant</option> 
                								<option value="Homme">Homme</option> 
                								<option value="Femme">Femme</option> 
                							</select>
                						</div>
                						<div class="col-md-6">
                							<label class="label-form">Type du Produit :</label>
                							<select class="form-control" name="type">
                								<option value="Unifocaux">Unifocaux</option> 
                								<option value="Progressifs">Progressifs</option> 
                								<option value="Sans Correction">Sans Correction</option> 
                							</select>
                						</div>
                					</div><br>
                					<div class="group-form">
                						<label class="label-form">La Largeur du Lunette :</label>
                						<input type="number" class="form-control" name="largeur" required="required">
                					</div><br>
                					<div class="group-form">
                						<label class="label-form">Description :</label>
                						<textarea class="form-control" name="desc" rows="3" cols="12" maxlength="200" required="required"></textarea>
                					</div><br> 
                					<div class="group-form">
                						<label class="label-form">Photo :</label>
                						<input type="file" class="form-control" name="photo[]" multiple="multiple">
                					</div><br>
                              	</div> 
                               	<div class="modal-footer">
                               		<div class="container col-md-12">
                                   		<div class="row">
                                   			<div class="col-md-6">
                                   				<button type="button" class="btn btn-secondary" data-dismiss="modal" style="width: 100%;">Annuler</button>
                                   			</div>
                                   			<div class="col-md-6">
                                   				<button type="submit" name="Enregistrer" class="form-control btn btn-primary" data-toggle="modal" data-target="exampleModal1">Enregistrer</button>
                                   			</div>
                                   		</div>
                               		</div>
                              	</div>
                          	</form>
                     	</div>
                  	</div>
              	</div>
              	<?php 
                  	$que_prod = "select p.ref_Produit, p.titre, c.descrip_cat from produit p, categorie c where p.ref_cat = c.ref_cat";
                  	$rs_prod = mysqli_query($con, $que_prod);
              	?>
              	<div class="modal fade" id="exampleModal23" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                	<div class="modal-dialog">
                     	<div class="modal-content">
                        	<div class="modal-header" style="text-align: center;">
                             	<h5 class="modal-title" id="exampleModalLabel">Postuler Une Promotion </h5>
                               	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 	<span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="promo.php" method="post" enctype="multipart/form-data">
                             	<div class="modal-body">
									<div class="row">
                           				<div class="col-md-6">
                            				<label>Produit Concerne</label>
                                			<select class="form-control" name="prod">
                                				<?php while ($et_prod = mysqli_fetch_assoc($rs_prod)){ ?>
                                					<option value="<?php echo $et_prod["ref_Produit"] ?>"><?php echo $et_prod["titre"] . " - " . $et_prod["descrip_cat"] ?></option>
                                				<?php } ?>
                                			</select>
                            			</div>
                            			<div class="col-md-6">
                            				<label>Remise en (%)</label>
                            				<input type="number" name="rem" min="0" max="100" class="form-control" required="required">
                            			</div>
                            		</div><br>  						
                            		<div class="row">
                            			<div class="col-md-6">
                            				<label>Date Debut du Promotion</label>
                            				<input type="date" name="debut" class="form-control" required="required">
                            			</div>
                            			<div class="col-md-6">
                            				<label>Duree en (Jour)</label>
                            				<input type="number" name="duree" min="0" class="form-control" required="required">
                            			</div>
                            		</div><br>
                            	</div>
                            	<div class="modal-footer">
                            		<div class="container col-md-12">
                                		<div class="row">
                                			<div class="col-md-6">
                                				<button type="button" class="form-control btn btn-secondary" style="color: white; width: 100%;">Annuler</button>
                                			</div>
                                			<div class="col-md-6">
                                				<button type="submit" name="conf" class="form-control btn btn-primary" data-toggle="modal" data-target="exampleModal23" style="color: white; width: 100%;">Confirmer</button>
                                			</div>
                                		</div>
                            		</div>
                            	</div>
                            </form> 
                    	</div>
                  	</div>	
              	</div>
                               	
              	
              	<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                	<div class="modal-dialog">
                     	<div class="modal-content">
                        	<div class="modal-header" style="text-align: center;">
                             	<h5 class="modal-title" id="exampleModalLabel">Ajouter des Lentilles </h5>
                               	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 	<span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="AjouterLentille.php" method="post" enctype="multipart/form-data">
                             	<div class="modal-body">
									<div class="group-form">
                            			<label class="label-form">Categorie :</label>
                            			<select class="form-control" name="cat">
                            				<?php while ($et_load_cat_lent = mysqli_fetch_assoc($rs_load_cat_lent)){ ?>
                            					<option value="<?php echo $et_load_cat_lent["ref_cat"] ?>"><?php echo $et_load_cat_lent["descrip_cat"] ?></option>
                            				<?php } ?>
                            			</select>
                            		</div><br>
                          			<div class="group-form">
                            			<label class="label-form">Nom d'Article :</label>
                            			<input type="text" class="form-control" name="titre" maxlength="50" required="required">
                            		</div><br>
                            		<div class="group-form">
                            			<label class="label-form">Type :</label>
                            			<select class="form-control" name="type">
                            				<option value="Cosmetique">Cosmetique</option> 
                            				<option value="Correction">Correction</option> 
                            			</select>
                            		</div><br>
                            		<div class="group-form">
                            			<label class="label-form">Ref Lentille :</label>
                            			<input type="text" class="form-control" name="ref" maxlength="100" required="required">
                            		</div><br>
                            		<div class="row">
                                		<div class="col-md-6">
                                			<label class="label-form">Quantite Stocke :</label>
                                			<input type="number" class="form-control" name="qte" min="1" required="required">
                                		</div>
                             			<div class="col-md-6">
                                			<label class="label-form">Prix du Vente :</label>
                                			<input type="number" class="form-control" name="prix" min="1" required="required">
                                		</div>
                                	</div><br>	
                            		<div class="group-form">
                            			<label class="label-form">Description :</label>
                            			<textarea class="form-control" name="desc" rows="3" cols="12" maxlength="200" required="required"></textarea>
                            		</div><br> 
                            		<div class="group-form">
                            			<label class="label-form">Photo :</label>
                            			<input type="file" class="form-control" name="photo[]" multiple="multiple">
                            		</div><br>		
                              	</div>
                               	<div class="modal-footer">
                               		<div class="container col-md-12">
                                   		<div class="row">
                                   			<div class="col-md-6">
                                   				<button type="button" class="btn btn-secondary" data-dismiss="modal" style="width: 100%;">Annuler</button>
                                   			</div>
                                   			<div class="col-md-6">
                                   				<button type="submit" name="Enregistrer" class="form-control btn btn-primary" data-toggle="modal" data-target="exampleModal2">Enregistrer</button>
                                   			</div>
                                   		</div>
                               		</div>
                              	</div>
                          	</form>
                     	</div>
                  	</div>
              	</div>
              	
              	
              	<div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                	<div class="modal-dialog">
                     	<div class="modal-content">
                        	<div class="modal-header" style="text-align: center;">
                             	<h5 class="modal-title" id="exampleModalLabel">Creation d'un Compte </h5>
                               	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 	<span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="CreerCompte.php" method="post" enctype="multipart/form-data">
                             	<div class="modal-body">
									<div class="row">
                        				<div class="col-md-4">
                        					<label class="label-form">Nom :</label>
                        					<input type="text" name="nom" class="form-control" maxlength="20" required="required">
                        				</div><br>
                        				<div class="col-md-4">
                        					<label class="label-form">Prenom :</label>
                        					<input type="text" class="form-control" name="prenom" maxlength="20" required="required">
                        				</div><br>
                        				<div class="col-md-4">
                        					<label class="label-form">Sexe :</label>
                        					<select name="sexe" class="form-control">
                        						<option value="Femme">Femme</option> 
                        						<option value="Homme">Homme</option> 
                        					</select> 
                        				</div><br>
                        			</div><br>
                   					<div class="row">
                        				<div class="col-md-6">
                        					<label class="label-form">E-mail *</label>
                        					<input type="email" name="email" class="form-control" maxlength="50" required="required">
                        				</div><br>
                        				<div class="col-md-6">
                        					<label class="label-form">Telephone	 :</label>
                        					<input type="text" class="form-control" name="tele" maxlength="10" required="required">
                        				</div><br>
                        			</div><br>
                   					<div class="row">
                        				<div class="col-md-6">
                        					<label class="label-form">Ville :</label>
                        					<input type="text" name="ville" class="form-control" maxlength="20" required="required">
                        				</div><br>
                        				<div class="col-md-6">
                        					<label class="label-form">Adresse :</label>
                        					<textarea rows="1" class="form-control" name="adr" maxlength="100" required="required"></textarea>
                        				</div><br>
                        			</div><br>
                   					<div class="row">
                        				<div class="col-md-6">
                        					<label class="label-form">Couverture Medicale :</label>
                        					<select name="couv_medi" class="form-control">
                        						<option value="CNOPS">CNOPS</option> 
                        						<option value="CNSS">CNSS</option> 
                        						<option value="RAMID">RAMID</option> 
                        						<option value="Neant">Neant</option> 
                        					</select> 
                        				</div><br>
                        				<div class="col-md-6">
                        					<label class="label-form">Role :</label>
                        					<select name="role" class="form-control">
                        						<option value="Client">Client</option> 
                        						<option value="Fournisseur">Fournisseur</option> 
                        						<option value="Opticien">Opticien</option> 
                        					</select>
                        				</div><br>
                        			</div><br>
                        			<div class="row">
                        				<input type="file" name="img" class="form-control">
                        			</div><br>
                              	</div>
                               	<div class="modal-footer">
                               		<div class="container col-md-12">
                                   		<div class="row">
                                   			<div class="col-md-6">
                                   				<button type="button" class="btn btn-secondary" data-dismiss="modal" style="width: 100%;">Annuler</button>
                                   			</div>
                                   			<div class="col-md-6">
                                   				<button type="submit" name="Enregistrer" class="form-control btn btn-primary" data-toggle="modal" data-target="exampleModal4">Enregistrer</button>
                                   			</div>
                                   		</div>
                               		</div>
                              	</div>
                          	</form>
                     	</div>
                  	</div>
              	</div>
              	
              	<div class="modal fade" id="exampleModal7" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                	<div class="modal-dialog">
                     	<div class="modal-content">
                        	<div class="modal-header" style="text-align: center;">
                             	<h5 class="modal-title" id="exampleModalLabel">Modification du Compte </h5>
                               	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 	<span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="" method="post" enctype="multipart/form-data">
                            	<?php while ($et_para = mysqli_fetch_assoc($rs_para)){ ?>
                             	<div class="modal-body">
									<div class="row">
                        				<div class="col-md-4">
                        					<label>Nom</label>
                        					<input type="text" name="nom_para" class="form-control" value="<?php echo $et_para["nom"] ?>" required="required">
                        				</div>
                        				<div class="col-md-4">
                        					<label>Prenom</label>
                        					<input type="text" name="pre_para" class="form-control" value="<?php echo $et_para["prenom"] ?>" required="required">
                        				</div>
                        				<div class="col-md-4">
                        					<label>Sexe</label>
                        					<select name="sexe_para" class="form-control">
                        						<option value="Femme">Femme</option>
                        						<option value="Homme">Homme</option> 
                        					</select>
                        				</div>
                        			</div><br>
                   					<div class="row">
                        				<div class="col-md-6">
                        					<label class="label-form">Couverture Medicale :</label>
                        					<select name="couv_medi_para" class="form-control">
                        						<option value="CNOPS">CNOPS</option> 
                        						<option value="CNSS">CNSS</option> 
                        						<option value="RAMID">RAMID</option> 
                        						<option value="Neant">Neant</option> 
                        					</select>
                        				</div><br>
                        				<div class="col-md-6">
                        					<label class="label-form">Telephone	 :</label>
                        					<input type="text" class="form-control" name="tele_para" maxlength="10" value="<?php echo $et_para["telephone"] ?>" required="required">
                        				</div><br>
                        			</div><br>
                   					<div class="row">
                        				<div class="col-md-6">
                        					<label class="label-form">Ville :</label>
                        					<input type="text" name="ville_para" class="form-control" maxlength="20" value="<?php echo $et_para["ville"] ?>" required="required">
                        				</div><br>
                        				<div class="col-md-6">
                        					<label class="label-form">Adresse :</label>
                        					<textarea rows="1" class="form-control" name="adr_para" maxlength="100" required="required"><?php echo $et_para["adresse"] ?></textarea>
                        				</div><br>
                        			</div><br>
                        			<div class="row">
                        				<div class="col-md-6">
                        					<label>Ancien Mot de Passe *</label>
                        					<input type="password" name="old_pwd" class="form-control">
                        				</div>
                        				<div class="col-md-6">
                        					<label>Nouveau Mot de Passe *</label>
                        					<input type="password" name="new_pwd" class="form-control">
                        				</div>
                        			</div><br>
                   					<div class="row">
                        				<div class="col-md-8">
                        					<label class="label-form">E-mail *</label>
                        					<input type="email" name="email_para" class="form-control" maxlength="50" disabled="disabled" value="<?php echo $et_para["email"] ?>" required="required">
                        				</div>
   										<div class="col-md-4" style="text-align: center; padding-bottom: 0; padding-top: 7px;">
   											<img src="<?php echo 'img/' . $et_para["img"] ?>" width="50px">
   										</div>
                        			</div><br>
                        			<div class="row">
                        				<input type="file" name="img" class="form-control">
                        			</div><br>
                              	</div>
                               	<div class="modal-footer">
                               		<div class="container col-md-12">
                                   		<div class="row">
                                   			<div class="col-md-6">
                                   				<button type="button" class="btn btn-secondary" data-dismiss="modal" style="width: 100%;">Annuler</button>
                                   			</div>
                                   			<div class="col-md-6">
                                   				<button type="submit" name="modifier" class="form-control btn btn-primary" data-toggle="modal" data-target="exampleModal7">Valider</button>
                                   			</div>
                                   		</div>
                               		</div>
                              	</div>
                              	<?php } ?>
                          	</form>
                     	</div>
                  	</div>
              	</div>
			</div>
		</div>
		

<?php 

if(isset($_POST["modifier"])){
    
    $nom = $_POST["nom_para"];
    $pre = $_POST["pre_para"];
    $sexe = $_POST["sexe_para"];
    $couv_medi = $_POST["couv_medi_para"];
    $tele = $_POST["tele_para"];
    $ville = $_POST["ville_para"];
    $adr = $_POST["adr_para"];
    $email = $_SESSION["email"];
    
    
    
    $nom_rep = str_replace("'", "\'", $nom);
    $pre_rep = str_replace("'", "\'", $pre);
    $tele_rep = str_replace("'", "\'", $tele);
    $ville_rep = str_replace("'", "\'", $ville);
    $adr_rep = str_replace("'", "\'", $adr);
    
    if(!empty($_POST["old_pwd"]) && !empty($_POST["new_pwd"])){
        $old_pwd = $_POST["old_pwd"];
        $new_pwd = $_POST["new_pwd"];
        
        $old_rep = str_replace("'", "\'", $old_pwd);
        $new_rep = str_replace("'", "\'", $new_pwd);
        
        $que = "select pwd from users where email = '" . $email . "' and pwd = '" . $old_pwd . "'";
        $rs_que = mysqli_query($con, $que);
        if(mysqli_num_rows($rs_que) > 0){
            if(empty($_FILES["img"]["name"])){
                $query = "update users set nom = '" . $nom_rep . "', prenom = '" . $pre_rep . "', sexe = '" . $sexe . "', couv_medi = '" . $couv_medi . "', telephone = '" . $tele_rep . "', ville = '" . $ville_rep . "', adresse = '" . $adr_rep . "', pwd = '" . $new_rep . "' where email = '" . $email . "'";
                if(mysqli_query($con, $query)){
                    
                }
            }
            else{
                $img = $_FILES["img"]["name"];
                $tmp_img = $_FILES["img"]["tmp_name"];
                move_uploaded_file($tmp_img, 'img/' . $img);
                $query = "update users set nom = '" . $nom_rep . "', prenom = '" . $pre_rep . "', sexe = '" . $sexe . "', couv_medi = '" . $couv_medi . "', telephone = '" . $tele_rep . "', ville = '" . $ville_rep . "', adresse = '" . $adr_rep . "', pwd = '" . $new_rep . "', img = '" . $img . "' where email = '" . $email . "'";
                if(mysqli_query($con, $query)){
                    
                }
            }
        }
    }
    else {
        if(empty($_FILES["img"]["name"])){
            $query = "update users set nom = '" . $nom_rep . "', prenom = '" . $pre_rep . "', sexe = '" . $sexe . "', couv_medi = '" . $couv_medi . "', telephone = '" . $tele_rep . "', ville = '" . $ville_rep . "', adresse = '" . $adr_rep . "' where email = '" . $email . "'";
            if(mysqli_query($con, $query)){
                
            }
        }
        else {
            $img = $_FILES["img"]["name"];
            $tmp_img = $_FILES["img"]["tmp_name"];
            move_uploaded_file($tmp_img, 'img/' . $img);
            $query = "update users set nom = '" . $nom_rep . "', prenom = '" . $pre_rep . "', sexe = '" . $sexe . "', couv_medi = '" . $couv_medi . "', telephone = '" . $tele_rep . "', ville = '" . $ville_rep . "', adresse = '" . $adr_rep . "', img = '" . $img . "' where email = '" . $email . "'";
            if(mysqli_query($con, $query)){
                
            }
        }
    }
    
    //header("location:Profiles.php");
}

?>


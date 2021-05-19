<?php

session_start();
require_once 'DB.php';

if(!empty($_GET["q"])){
    if($_GET["q"] == "Lunettes de Vue"){
        $query = "select * from produit p, categorie c where c.ref_cat = p.ref_cat and c.descrip_cat = 'Lunette de vue' order by p.ref_Produit desc";
    }
    elseif ($_GET["q"] == "Lunettes de Soleil"){
        $query = "select * from produit p, categorie c where c.ref_cat = p.ref_cat and c.descrip_cat = 'Lunette de Soleil' order by p.ref_Produit desc";
    }
    elseif ($_GET["q"] == "Lentilles"){
        $query = "select * from produit p, categorie c where c.ref_cat = p.ref_cat and c.descrip_cat = 'Les Lentilles' order by p.ref_Produit desc";
    }
    elseif ($_GET["q"] == "Lentille Correctrices"){
        $query = "select * from produit p, categorie c where c.ref_cat = p.ref_cat and p.type_lentille = 'Correction' order by p.ref_Produit desc";
    }
    elseif ($_GET["q"] == "Lentille Cosmetiques"){
        $query = "select * from produit p, categorie c where c.ref_cat = p.ref_cat and p.type_lentille = 'Cosmetique' order by p.ref_Produit desc";
    }
    $rs = mysqli_query($con, $query);
}
else {
    $query = "select * from produit p, categorie c where c.ref_cat = p.ref_cat order by p.ref_Produit desc";
    $rs = mysqli_query($con, $query);
}


if(isset($_POST["chercher"])){
     if(!empty($_POST["rd_v"])){
        if($_POST["rd_v"]=="Unifocaux"){
            $query = "select * from produit p, categorie c where c.ref_cat = p.ref_cat and p.type = 'Unifocaux' order by p.ref_Produit desc";
        }
        elseif ($_POST["rd_v"] == "Progressifs"){
            $query = "select * from produit p, categorie c where c.ref_cat = p.ref_cat and p.type = 'Progressifs' order by p.ref_Produit desc";
        }
        elseif ($_POST["rd_v"] == "Sans Correcrtion"){
            $query = "select * from produit p, categorie c where c.ref_cat = p.ref_cat and p.type = 'Sans Correction' order by p.ref_Produit desc";
        }
        $rs = mysqli_query($con, $query);
    }
    if(!empty($_POST["rd_p"])){
        if($_POST["rd_p"]=="Homme"){
            $query = "select * from produit p, categorie c where c.ref_cat = p.ref_cat and p.pour = 'Homme' order by p.ref_Produit desc";
        }
        elseif ($_POST["rd_p"] == "Femme"){
            $query = "select * from produit p, categorie c where c.ref_cat = p.ref_cat and p.pour = 'Femme' order by p.ref_Produit desc";
        }
        elseif ($_POST["rd_p"] == "Enfant"){
            $query = "select * from produit p, categorie c where c.ref_cat = p.ref_cat and p.pour = 'Enfant' order by p.ref_Produit desc";
        }
        $rs = mysqli_query($con, $query);
    }
    if(!empty($_POST["rd_t"])){
        if($_POST["rd_t"]=="fine"){
            $query = "select * from produit p, categorie c where c.ref_cat = p.ref_cat and p.largeur <= 131 order by p.ref_Produit desc";
        }
        elseif ($_POST["rd_t"] == "moyenne"){
            $query = "select * from produit p, categorie c where c.ref_cat = p.ref_cat and p.largeur between 132 and 138 order by p.ref_Produit desc";
        }
        elseif ($_POST["rd_t"] == "large"){
            $query = "select * from produit p, categorie c where c.ref_cat = p.ref_cat and p.largeur >= 139 order by p.ref_Produit desc";
        }
        $rs = mysqli_query($con, $query);
    }
    
    if(isset($_POST["prix"])){
        if(isset($_POST["cb_prix"])){
            $query = "select * from produit p, categorie c where c.ref_cat = p.ref_cat order by p.prix_vente asc";
        }
        elseif (!isset($_POST["cb_prix"])) {
            $query = "select * from produit p, categorie c where c.ref_cat = p.ref_cat order by p.prix_vente asc";
        }
        $rs = mysqli_query($con, $query);
    }
}


if(!empty($_SESSION["role"]) && !empty($_SESSION["email"]) && $_SESSION["role"] == "Client"){
    $role = $_SESSION["role"];
    $login = $_SESSION["email"];
    
    $que_nom_pre = "select nom, prenom from users where email = '" . $login . "' and role = '" . $role . "'";
    $rs_nom_pre = mysqli_query($con, $que_nom_pre);
    $et_nom_pre = mysqli_fetch_assoc($rs_nom_pre);
    $n = $et_nom_pre["nom"];
    $p = $et_nom_pre["prenom"];
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style="width:100%; height:70px; text-align:center; font-size:25px;">
                    Bienvenue Notre Chere Client <strong>' . $n . ' ' . $p . '</strong> !<br><br>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
          </div>';
    
    $que_para = "select * from users where email = '" . $_SESSION["email"] . "' and role = '" . $_SESSION["role"] . "'";
    $rs_para = mysqli_query($con, $que_para);
    
}


if(isset($_GET["vider"]) && $_GET["vider"] == "true" && isset($_GET["user"]) && !empty($_GET["user"])){
    $que_vider_panier = "update panier set status = 0 where ref_user in (select ref_client from users where email = '" . $_SESSION["email"] . "')";
    mysqli_query($con, $que_vider_panier);
    header("location:OptiqueShop.php");
}




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
		<style type="text/css">
		  .notify:hover{
    	       background: silver;
    	       color: black ;
    	   }
    	   .vl {
              border-left: 1px solid black;
              height: 200px;
              padding-left : 400px;
            }
            
          .st:hover {
              background-color: silver;
              color:black;
              font-weight: lighter;
            }
           .hh:hover{
              background-color: silver;
              color: black;
              border-radius: 3%;
            }
            .myCard:hover{
    	       background: #D6E9E7;
    	       border-radius: 20px;
    	   }
		</style>
	
		<div class="navbar navbar-expand-sm navbar-light bg-light">
			<marquee width="350px" height="70px"><a class="navbar-brand active" style="width: 350px;" href="OptiqueShop.php"><span><img src="./assets/yeux.jpg" width="50px"></span><span style="color: threedshadow; font-size : 22px; font-weight: bold; font-style: italic; font-family: fantasy;">Optique Shop</span><span style="font-size: 17px; color: blue;"><br><sub style="text-align: center;">Nous Sommes Pas Les Seuls, Mais Nous Sommes Les Meilleurs</sub></span></a></marquee>
			<button class="navbar-toggler" data-toggle="collapse" data-target="#nav"> 
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="nav">
    			<ul class="navbar-nav ml-auto">
    				<li class="nav-item menuu" style="padding-right: 50px; padding-left: 100px;">
    					<a href="OptiqueShop.php?q=<?php echo 'Lunettes de Vue' ?>" class="nav-link" style="width: 180px" ><span><img src="./assets/vue1.ico" width="25px"><?php echo "&nbsp; &nbsp;" ?></span>Lunettes de Vue</a>
    				</li>
    				
    				<li class="nav-item menuu" style="padding-right: 50px">
    					<a href="OptiqueShop.php?q=<?php echo 'Lunettes de Soleil' ?>" class="nav-link" style="width: 180px"><span><img src="./assets/soleil.ico" width="25px"><?php echo "&nbsp; &nbsp;" ?></span>Lunettes de Soleil</a>
    				</li>
    				
    				<li class="dropdown nav-item menuu" style="padding-right: 50px">
    					<a style="width: 180px" href="OptiqueShop.php?q=<?php echo 'Lentilles' ?>" class="nav-link dropdown-toggle" role="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
    						Lentilles de Contact
    					</a>
    					<div class="dropdown-menu navbar-light bg-light" aria-labelledby="dropdownMenuButton">
    						<a class="dropdown-item notify" href="OptiqueShop.php?q=<?php echo 'Lentille Correctrices' ?>" style="">Lentilles Correctrices</a>
    						<div class="dropdown-divider"></div>
    						<a class="dropdown-item notify" href="OptiqueShop.php?q=<?php echo 'Lentille Cosmetiques' ?>" style="">Lentilles Cosmetiques</a>
    				 	</div>
    				</li> 
    				<?php if(!empty($role) && !empty($login)){ ?>
    				<li class="nav-item dropdown">
    					<a href="panier.php" class="nav-link menuu dropdown-toggle" role="button" data-toggle="dropdown" style="padding-right: 100px">
    						<span class="label label-pill count"><img src="./assets/panier.ico" width="25px">
    							<?php $que_panier_notif = "select * from panier n, produit p, users u where n.ref_user = u.ref_client and n.ref_produit = p.ref_Produit and n.status = 1 and u.email = '" . $_SESSION["email"] . "'"; ?>
                                <?php $rs_panier_notif = mysqli_query($con, $que_panier_notif); ?>
    							<?php if($count_panier = mysqli_num_rows($rs_panier_notif) > 0){ ?>
    								<span class="badge position-absolute top-0 left-100 translate-middle bg-danger" style="background-color: red"><?php echo $count_panier ?></span>
    							<?php } ?> 
    						</span>
    					</a>
    					<?php if($count_panier == 0){ ?>
    						<ul class="dropdown-menu">
    							<li class="alert alert-info form-control" style="width: 250px; text-align: center; font-size: 18px"><a>Panier est Vide </a></li> 
    						</ul>
    					<?php } else { ?>
    						<ul class="dropdown-menu" style="width: 340px;">
    							<div class="col-md-12">
        							<div class="row">
        								<div class="col-md-6">
        									<a href="OptiqueShop.php?vider=true&user=<?php echo $_SESSION["email"] ?>" class="btn btn-outline-warning">Vider Mon Panier</a>
        								</div>
        								<div class="col-md-6">
        									<a href="paniers.php?ref_cli=<?php echo $_SESSION["email"] ?>" class="btn btn-info">Lister Mon Panier</a>
        								</div>
        							</div>
        							<div class="dropdown-divider"></div>
        						</div>
    							<?php while ($fetch_panier_notif = mysqli_fetch_assoc($rs_panier_notif)){ ?>
    								<a href="paniers.php?ref_prod=<?php echo $fetch_panier_notif['ref_produit'] ?>" style="text-decoration: none;">
        								<li class="myCard" style="width: 340px">
        									<div class="row g-0">
        										<div class="col-md-4" style="padding-left: 30px; padding-top: 30px; padding-bottom: 30px">
                        							<?php $pic = "SELECT ph.photo as imgg from photo ph, produit p WHERE p.ref_Produit = ph.ref_produit and p.ref_Produit = " . $fetch_panier_notif["ref_Produit"] . " ORDER by ph.ref_photo DESC LIMIT 1"; ?>
                                            		<?php $rs_pic = mysqli_query($con, $pic) ?>
                                            		<?php $data_pic = mysqli_fetch_assoc($rs_pic); ?>
                                                   	<img src="<?php echo 'img/'.$data_pic['imgg'] ?>" width="90" height="90" style="border-radius: 20px;">
                                            	</div> 	
                                            	<div class="col-md-8" style="padding-top: 30px">
                                            		<h5><?php echo $fetch_panier_notif['titre'] ?></h5>
                    								<p style="color: black"><?php echo $fetch_panier_notif['prix_vente'] . " DH" ?></p>
                    								<footer class="bottom">
                    									<small class="text-muted"><?php echo $fetch_panier_notif["date_like"] ?></small>
                    								</footer>
                    							</div>
                							</div>
                							<div class="dropdown-divider"></div>
                						</li>
            						</a>
    							<?php } ?>
    						</ul> 
    					<?php } ?>
    				</li>
    				<?php } ?>
        			<li class="nav-item" style="padding-right: 5px">
        				<?php if(empty($role) || empty($login)){ ?>
        				<button name="connecter" class="nav-link btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="color: white;">Se Connecter</button>
        				<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        	<div class="modal-dialog">
                            	<div class="modal-content">
                              		<div class="modal-header">
                                		<h5 class="modal-title" id="exampleModalLabel">Authentication Form </h5>
                                		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  			<span aria-hidden="true">&times;</span>
                                		</button>
                              		</div>
                              		<form action="verif.php" method="post">
                                  		<div class="modal-body">
                                    		<div class="group-form">
                                    			<div class="input-group mb-3">
                                                	<div class="input-group-prepend">
                                                    	<span class="input-group-text" id="basic-addon1"><img src="./assets/mail.ico" width="25px"></span>
                                                  	</div>
      												<input type="email" name="email" class="form-control" placeholder="E-mail" aria-label="E-mail" aria-describedby="basic-addon1" width="300px" required="required">
    											</div><br><br>
                                    			<div class="input-group mb-3">
                                                	<div class="input-group-prepend">
                                                    	<span class="input-group-text" id="basic-addon1"><img src="./assets/pwd.ico" width="25px"></span>
                                                  	</div>
      												<input type="password" name="pwd" class="form-control" aria-label="password" aria-describedby="basic-addon1" width="300px" required="required">
    											</div>
                                    		</div>
                                  		</div>
                                  		<div class="modal-footer">
                                  			<div class="container col-md-12">
                                  				<div class="row">
                                  					<div class="col-md-6">
                                  						<button type="button" class="btn btn-secondary form-control" data-dismiss="modal">Annuler</button>
                                  					</div>
                                  					<div class="col-md-6">
                                  						<button type="submit" class="btn btn-primary form-control" name="Connecter" data-toggle="modal" data-target="exampleModal">Se Connecter</button>
                                  					</div>
                                  				</div>
                                  			</div>
                                  		</div>
                              		</form>
                            	</div>
                          	</div>
                    	</div>
                    	<?php } ?>
        			</li>	
        			<?php if(empty($role) || empty($login)){ ?>
        				<li class="nav-item" style="padding-right: 30px;">
        					<button class="nav-link btn btn-light" type="button" style="width: 110px; color: blue;" data-toggle="modal" data-target="#exampleModal100">Sign-Up</button>
        				</li>
        			<?php } else { ?>
        					<li class="dropdown nav-item menuu" style="padding-right: 30px">
                				<a href="#" style="width: 180px" class="nav-link dropdown-toggle" role="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                					<span><img src=""><?php echo "&nbsp; &nbsp;" ?></span>Mon Compte
                				</a>
                				<div class="dropdown-menu navbar-light bg-light" aria-labelledby="dropdownMenuButton">
            						<a class="dropdown-item notify" href="#" style="">Dashboard</a>
            						<div class="dropdown-divider"></div>
            						<button type="button" class="dropdown-item notify" data-toggle="modal" data-target="#exampleModal7" style="">Settings</button>
            						<div class="dropdown-divider"></div>
            						<a class="dropdown-item notify" href="logout.php" style="">Log Out [ <?php echo ((isset($_SESSION['email']))?($_SESSION['email']):"") ?> ]</a>
            					</div>
        					</li>
        			<?php } ?>
    			</ul>
				<div class="modal fade" id="exampleModal7" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                	<div class="modal-dialog">
                     	<div class="modal-content">
                        	<div class="modal-header" style="text-align: center;">
                             	<h5 class="modal-title" id="exampleModalLabel">Modification du Compte </h5>
                               	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 	<span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="settings.php" method="post" enctype="multipart/form-data">
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
                                   				<button type="submit" name="modifier" class="form-control btn btn-primary" data-toggle="modal" data-target="exampleModal7">Enregistrer</button>
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
		
		<div class="" style="height: 1635px;">
			<div class=" row" style="margin-top: 2%">
				<div class="col-md-4" style="height: 2000px; width: 100%">
					<div class="card bg-light" style="height: 525px; margin-left: 6%">
						<div class="card-title" style="color: black; font-size: 20px; text-align: center; padding-top: 5%;">Horaires d'Ouverture :</div>
						<div class="dropdown-divider"></div>
						<div class="card-body" style="padding-top: 3%;">
							<div class="alert alert-secondary" role="alert" style="padding-bottom: 2%; padding-top: 6%;">
                            	<div class="input-group mb-3">
                                	<div class="input-group-prepend">
                                    	<span class="input-group-text" id="basic-addon1" style="width: 120px;">Lundi</span>
                                    </div>
      								<label class="form-control" aria-describedby="basic-addon1" style="text-align: center;">8:30 - 16:30</label>
    							</div>
    							<div class="input-group mb-3">
                                	<div class="input-group-prepend">
                                    	<span class="input-group-text" id="basic-addon1" style="width: 120px;">Mardi</span>
                                    </div>
      								<label class="form-control" aria-describedby="basic-addon1" style="text-align: center;">8:30 - 16:30</label>
    							</div>
    							<div class="input-group mb-3">
                                	<div class="input-group-prepend">
                                    	<span class="input-group-text" id="basic-addon1" style="width: 120px;">Mercredi</span>
                                    </div>
      								<label class="form-control" aria-describedby="basic-addon1" style="text-align: center;">8:30 - 16:30</label>
    							</div>
    							<div class="input-group mb-3">
                                	<div class="input-group-prepend">
                                    	<span class="input-group-text" id="basic-addon1" style="width: 120px;">Jeudi</span>
                                    </div>
      								<label class="form-control" aria-describedby="basic-addon1" style="text-align: center;">8:30 - 16:30</label>
    							</div>
    							<div class="input-group mb-3">
                                	<div class="input-group-prepend">
                                    	<span class="input-group-text" id="basic-addon1" style="width: 120px;">Vendredi</span>
                                    </div>
      								<label class="form-control" aria-describedby="basic-addon1" style="text-align: center;">8:30 - 16:30</label>
    							</div>
    							<div class="input-group mb-3">
                                	<div class="input-group-prepend">
                                    	<span class="input-group-text" id="basic-addon1" style="width: 120px;">Samedi</span>
                                    </div>
      								<label class="form-control" aria-describedby="basic-addon1" style="text-align: center;">8:30 - 13:00</label>
    							</div>
    							<div class="input-group mb-3">
                                	<div class="input-group-prepend">
                                    	<span class="input-group-text" id="basic-addon1" style="width: 120px;">Dimanche</span>
                                    </div>
      								<label class="form-control" aria-describedby="basic-addon1" style="text-align: center;">Fermer</label>
    							</div>
                            </div>
						</div>
					</div>
					<div class="card bg-dark" style="height: 452px; margin-left: 6%; margin-top: 6%;">
						<div class="card-body">
							<marquee><div class="" style="color: white; text-align: center; font-size: 18px; padding-top: 2%; padding-left: 3%; margin-right: 3%;">Consultation ou bien Une Visite! Bienvenue sur Notre Cabinet <span><img src="./assets/emo.ico" width="30px"></span></div></marquee>
							<br><br>
							<div class="row">
        						<button class="btn btn-success form-control" type="button" style="margin-right : 9%; margin-left : 9%;" data-toggle="modal" data-target="#exampleModal1">Nouvelle Visite</button>
                        	</div>
                        	
                        	
                        	<!-- SLIDER -->
                        	<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" style="height: 300px; width: 415px; padding-top: 4%;">
                            	<ol class="carousel-indicators">
                                    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                              	</ol>
                              	<div class="carousel-inner">
                                	<div class="carousel-item active">
                                  		<img src="./assets/vue1.ico" width="415px" height="300px" class="d-block w-100" alt="...">
                                	</div>
                                	<div class="carousel-item">
                                  		<img src="./assets/vue.ico" width="415px" height="300px" class="d-block w-100" alt="...">
                                	</div>
                                	<div class="carousel-item">
                                  		<img src="./assets/yeux.jpg" width="415px" height="300px" class="d-block w-100" alt="...">
                                	</div>
                              	</div>
                              	<a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                              	</a>
                              	<a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                              	</a>
                            </div>
                            <!-- END OF SLIDER -->
						</div>
					</div>
				</div>
				<div class="col-md-8" style="height: 1600px; width: 600px; margin-bottom: 0;">
					<div class="card bg-light" style="height: 100%;margin-right: 3%">
						<div class="card-body" style="height: 750px;">
							<form action="" method="post">
    							<div class="alert alert-secondary" style="height: 400px; padding-top: 2%; padding-left:2%; padding-right:2%; margin-top: 0; margin-left: 0; margin-right: 0;">
    								<div class="row" style="padding-top: 2%;">
        								<div class="col-md-4">
        									<div class="form-group">
        										<label class="label-form">Pour des Verres</label><br> 
        										<div class="input-group mb-3" >
                                                	<div class="input-group-prepend">
                                                    	<span class="input-group-text" id="basic-addon1" style="width: 40px;"><input type="radio" value="Unifocaux" name="rd_v"></span>
                                                    </div>
                      								<label class="form-control" aria-describedby="basic-addon1" style="text-align: center;">Unifocaux</label>
                    							</div> 
        										<div class="input-group mb-3">
                                                	<div class="input-group-prepend">
                                                    	<span class="input-group-text" id="basic-addon1" style="width: 40px;"><input type="radio" value="Progressifs" name="rd_v"></span>
                                                    </div>
                      								<label class="form-control" aria-describedby="basic-addon1" style="text-align: center;">Progressifs</label>
                    							</div>
                    							<div class="input-group mb-3">
                                                	<div class="input-group-prepend">
                                                    	<span class="input-group-text" id="basic-addon1" style="width: 40px;"><input type="radio" value="Sans Correcrtion" name="rd_v"></span>
                                                    </div>
                      								<label class="form-control" aria-describedby="basic-addon1" style="text-align: center;">Sans Correction</label>
                    							</div><br>  
        									</div>
        								</div>
        								<div class="col-md-4">
        									<div class="form-group">
        										<label class="label-form">Lunettes Pour</label><br> 
        										<div class="input-group mb-3" >
                                                	<div class="input-group-prepend">
                                                    	<span class="input-group-text" id="basic-addon1" style="width: 40px;"><input type="radio" value="Femme" name="rd_p"></span>
                                                    </div>
                      								<label class="form-control" aria-describedby="basic-addon1" style="text-align: center;">Femme</label>
                    							</div> 
        										<div class="input-group mb-3">
                                                	<div class="input-group-prepend">
                                                    	<span class="input-group-text" id="basic-addon1" style="width: 40px;"><input type="radio" value="Homme" name="rd_p"></span>
                                                    </div>
                      								<label class="form-control" aria-describedby="basic-addon1" style="text-align: center;">Homme</label>
                    							</div>
                    							<div class="input-group mb-3">
                                                	<div class="input-group-prepend">
                                                    	<span class="input-group-text" id="basic-addon1" style="width: 40px;"><input type="radio" value="Enfant" name="rd_p"></span>
                                                    </div>
                      								<label class="form-control" aria-describedby="basic-addon1" style="text-align: center;">Enfant</label>
                    							</div><br>  
        									</div>
        								</div>
        								<div class="col-md-4" >
        									<div class="form-group">
        										<label class="label-form">Largeur du Visage - tête</label><br> 
        										<div class="input-group mb-3" >
                                                	<div class="input-group-prepend">
                                                    	<span class="input-group-text" id="basic-addon1" style="width: 40px;"><input type="radio" name="rd_t" value="fine"></span>
                                                    </div>
                      								<label class="form-control" aria-describedby="basic-addon1" style="text-align: center;">Fine : (≤ 131mm)</label>
                    							</div> 
        										<div class="input-group mb-3">
                                                	<div class="input-group-prepend">
                                                    	<span class="input-group-text" id="basic-addon1" style="width: 40px;"><input type="radio" name="rd_t" value="moyenne"></span>
                                                    </div>
                      								<label class="form-control" aria-describedby="basic-addon1" style="text-align: center;">Moyenne (132 - 138mm)</label>
                    							</div>
                    							<div class="input-group mb-3">
                    								<div class="input-group-prepend">
                                                    	<span class="input-group-text" id="basic-addon1" style="width: 40px;"><input type="radio" name="rd_t" value="large"></span>
                                                    </div>
                      								<label class="form-control" aria-describedby="basic-addon1" style="text-align: center;">Large : (≥ 139mm)</label>
                    							</div>
        									</div>
        								</div>
        							</div>
        							<div class="row">
            							<div class="container col-md-4">
                							<div class="input-group mb-3 form-control st" style="text-align: center;">
                								<div class="input-group-prepend">
                                                  	<label>Trier Par : <?php echo "&nbsp;&nbsp;&nbsp;" ?></label>
                                                    <span class="" id="basic-addon1" style="width: 80px;"><span><img src="./assets/bas.ico" width="25px"></span><a type="submit"><input type="checkbox" name="cb_prix"></a></span>
                                                </div>
                                  				<label class="" aria-describedby="basic-addon1" style="text-align: center;">Moins Cher</label>
                                			</div>
                						</div>     						 
            						</div> 
        							<div class="">
        								<div class="container col-md-6 col-md-offset-3" style="padding-top: 0;">
        									<button type="submit" class="btn btn-outline-secondary form-control" name="chercher">Chercher</button>
        								</div>
        							</div>
    							</div>
    						</form> 
    						<div class="row" style="padding-top: 3%;">
    							<?php if(mysqli_num_rows($rs) != 0){ ?>
        							<?php while ($et = mysqli_fetch_assoc($rs)) { ?>
        								<?php $que_img = "select photo from photo where ref_produit = " . $et["ref_Produit"] . " order by ref_photo limit 1"; ?>
        								<?php $rs_img = mysqli_query($con, $que_img); ?>
        								<?php while($et_img = mysqli_fetch_assoc($rs_img)){ ?>
        									
                								<div class="col-md-3">
                									<div class="card" style="height: 500;">
                                    					<?php if(!empty($_SESSION["email"])){ ?>
                                    						<?php $que_panier = "select p.status as st from panier p, users u where p.ref_user = u.ref_client and p.ref_produit = " . $et["ref_Produit"] . " and u.email = '" . $_SESSION["email"] . "'"; ?>
                                    						<?php $rs_panier = mysqli_query($con, $que_panier); ?>
                                    						<?php while ($et_panier = mysqli_fetch_assoc($rs_panier)){ ?>
                                    							<?php if($et_panier["st"] == 0){ ?>
                                    								<a href="panier.php?produit=<?php echo $et["ref_Produit"] ?>&client=<?php echo $_SESSION["email"] ?>"><span class="btn btn-outline-danger pull-left"><img src="assets/panier.ico" width="20"></span></a>
                                    							<?php } elseif ($et_panier["st"] == 1){ ?>
                                    								<a href="panier.php?produit=<?php echo $et["ref_Produit"] ?>&client=<?php echo $_SESSION["email"] ?>"><span class="btn btn-outline-success pull-left"><img src="assets/panier.ico" width="20"></span></a>
                                    							<?php } ?>
                                    						<?php } ?>
                                    						<?php $que_rest = "SELECT * FROM produit p WHERE p.ref_Produit not in (SELECT n.ref_produit FROM panier n)"; ?>
                                    						<?php $rs_rest = mysqli_query($con, $que_rest); ?>
                                    						<?php while ($et_rest = mysqli_fetch_assoc($rs_rest)){ ?>
                                        						<?php if($et["ref_Produit"] == $et_rest["ref_Produit"]){ ?>
                                        							<a href="panier.php?produit=<?php echo $et["ref_Produit"] ?>&client=<?php echo $_SESSION["email"] ?>"><span class="btn btn-outline-secondary pull-left"><img src="assets/panier.ico" width="20"></span></a>
                                        						<?php } ?>
                                    						<?php } ?>
                                    					<?php } else { ?>
                                    						<button class="btn btn-outline-secondary pull-left" type="submit" data-toggle="modal" data-target="#exampleModal"><img src="assets/panier.ico" width="20"></button>
                                    					<?php } ?>
                                    					<a href="#" class="" style="text-decoration: none;">
                                        					<div class="card-img-top" style="text-align: center; padding-top: 15%;"><img src="./img/<?php echo $et_img["photo"]  ?>" width="150" height="100"></div>
                                           					<div class="card-body">
                                               					<p style="color: black; font-size: 14px;"><?php echo $et["descrip"] ?></p>
                                               					<p><?php echo $et["descrip_cat"] ?></p> 
                                               				</div>
                                               				<div class="card-footer">
                                               					<h3 style="margin-bottom: 1%"><?php echo $et["prix_vente"] . " DH" ?></h3>
                                               				</div>
                                           				</a> 
                                   					</div><br>	
                        						</div>
                							
                						<?php } ?>
            						<?php } ?>
        						<?php } else { ?>
        							<?php echo '<div class="alert alert-info" style="width:100%; text-align:center;">(0) Produits Pour l\'instant</div>' ?>
        						<?php } ?>
    						</div>
    					</div>
    				</div>
				</div>
			</div>
		</div>
		
		<footer>
			<?php require_once 'footer.php'; ?>
		</footer>
		
		<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        	<div class="modal-dialog">
            	<div class="modal-content">
                	<div class="modal-header">
                      	<h5 class="modal-title" id="exampleModalLabel">Rendez-Vous d'une Visite ou Consultation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        	<span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="visiter.php" method="post">
                    	<div class="modal-body">
                        	<input type="text" placeholder="Nom Complet" class="form-control" name="nom_complet" required="required"><br> 
                            <input type="text" placeholder="Téléphone" class="form-control" name="tele" required="required"><br>
                            <input type="email" placeholder="E-mail" class="form-control" name="email" required="required"><br>
                            <div class="row">
                              	<div class="col-md-6">
                                 	<input type="date" class="form-control" name="date" required="required">
                                </div>
                                <div class="col-md-6">
                                	<input min="9:00" max="16:00" type="time" class="form-control" name="time">
                                </div>
                            </div><br>
                            <textarea class="form-control" name="msg" placeholder="Votre Message ! " required="required"></textarea>
                       	</div>
                        <div class="modal-footer">
                          	<div class="container col-md-12">
                             	<div class="row">
                                	<div class="col-md-6">
                                      	<button type="button" class="btn btn-secondary form-control" style="width: 100%;" data-dismiss="modal">Annuler</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-success form-control" data-toggle="modal" data-target="exampleModal1" style="width: 100%;">Valider</button>
                                    </div>
                                </div>
                          	</div>
                       	</div>
                 	</form>
             	</div>
           </div>
     	</div>
     	
     	<div class="modal fade" id="exampleModal100" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     		<div class="container col-md-6 col-md-offset-3" style="padding-top: 5%;">
        		<div class="card">
        			<div class="card-header">Sign-Up</div>
            		<form action="signup.php" method="post" enctype="multipart/form-data">
                    	<div class="card-body">
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
                                   	<label class="label-form">Couverture Medicale :</label>
                                      	<select name="couv_medi" class="form-control">
                                          	<option value="CNOPS">CNOPS</option> 
                                            <option value="CNSS">CNSS</option> 
                                            <option value="RAMID">RAMID</option> 
                                            <option value="Neant">Neant</option> 
                                       	</select>
                               	</div><br>
                            </div><br>
                            <div class="group-form">
                               	<label class="label-form">Adresse :</label>
                                <textarea rows="1" class="form-control" name="adr" maxlength="100" required="required"></textarea> 
                           	</div><br>
                            <div class="group-form">
                             	<label class="label-form">Mot de Passe :</label>
                                <input type="password" name="pwd" class="form-control" maxlength="30" required="required"> 
                            </div><br>
                            <div class="row">
                               	<input type="file" name="img" class="form-control">
                            </div><br>
                     	</div>
                        <div class="card-footer">
                            <div class="container col-md-12">
                              	<div class="row">
                                  	<div class="col-md-6">
                                      	<a href="OptiqueShop.php" class="btn btn-secondary form-control">Annuler</a>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary form-control" data-toggle="modal" data-target="exampleModal100" name="Connecter">Enregistrer</button>
                                    </div>
                                </div>
                          	</div>
                       	</div>
                   	</form>
            	</div> 
            </div>
     	</div>
    </body>
</html>



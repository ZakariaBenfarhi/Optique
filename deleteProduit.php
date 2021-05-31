<?php
//if(!empty($_SESSION["role"]) && $_SESSION["role"] == "Opticien"){
    require_once 'redirectionIndex.php';
    require_once 'out.php';
    require_once 'DB.php';
    require_once 'headerAdmin.php';
    
    $ref = $_GET["ref"];
    
    if(isset($_POST["valider"])){
        
        $que_fact = "delete from facture where ref_commande in (select ref_commande from commande where ref_produit = " . $ref . ")";
        if(mysqli_query($con, $que_fact)){
            
            $que_img = "delete from photo where ref_produit = " . $ref;
            if(mysqli_query($con, $que_img)){
                
                $que_comm = "delete from commande where ref_produit = " . $ref;
                if(mysqli_query($con, $que_comm)){
                    
                    $que_achat = "delete from achat where ref_produit = " . $ref;
                    if(mysqli_query($con, $que_achat)){
                        
                        $que_panier = "delete from panier where ref_produit = " . $ref;
                        if(mysqli_query($con, $que_panier)){
                            
                            $que_remise = "delete from remise where ref_produit = " . $ref;
                            if(mysqli_query($con, $que_remise)){
                                
                                $que_promo = "delete from promotion where ref_produit = " . $ref;
                                if(mysqli_query($con, $que_promo)){
                                    $query = "delete from produit where ref_Produit = " . $ref;
                                    if(mysqli_query($con, $query)){
                                        echo '<div class="alert alert-success alert-dismissible fade show form-control" role="alert" style="text-align:center; font-size:25px;">
                                                Suppression avec Success
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>';
                                    }
                                    else {
                                        echo '<div class="alert alert-danger alert-dismissible fade show form-control" role="alert" style="text-align:center; font-size:25px;">
                                                Suppression a echouee !
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>';
                                    }
                                }
                            }
                        }
                        
                    }
                }
            } 
        }
    }
    
?> 

		<div class="container col-md-6 col-md-offset-3" style="padding-top: 10%;">
			<div class="card bg-warning ">
				<div class="card-header" style="font-size: 22px;">Confirmation du Supprission</div>
				<form action="" method="post">
       				<div class="card-body" style="text-align: center;">	
       					<label style="color: red; font-size: 25px; padding-top: 3%;"><strong> Voulez-Vous vraiment Supprimer cet Produit <?php echo $ref ?> !</strong></label>
       					<label style="color: red; font-size: 20px; padding-bottom: 3%;"><strong> Cet Produit sera Supprimer Permanent (Les Commandes, Les Factures et Les Achats...) ?</strong></label>
       				</div>
       				<div class="card-footer">
       					<div class="row">
        					<div class="col-md-6">
        						<a href="Produits.php" class="btn btn-secondary form-control">Annuler</a>
        					</div>
        					<div class="col-md-6">
        						<button type="submit" name="valider" class="btn btn-outline-danger form-control">Supprimer</button>
        					</div>
        				</div>
        			</div>
				</form>
			</div>
		</div>
	</body> 
</html>



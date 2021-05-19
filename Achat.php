<?php

require_once 'DB.php';
require_once 'headerAdmin.php';


$que = "select * from achat a, users u, produit p, categorie c where c.ref_cat = p.ref_cat and p.ref_Produit = a.ref_produit and a.ref_fourni = u.ref_client order by a.ref_achat desc";
$rs_que = mysqli_query($con, $que);

$que_four = "select * from users where role = 'Fournisseur' and status = 1 order by date_creation";
$rs_four = mysqli_query($con, $que_four);

$que_prod = "select * from produit p, categorie c where c.ref_cat = p.ref_cat";
$rs_prod = mysqli_query($con, $que_prod);

$que_Acat_TTC = "SELECT SUM(a.qte_achat * a.prix_achat) as TTC from achat a";
$rs_Achat_TTC = mysqli_query($con, $que_Acat_TTC);

if(isset($_POST["valider"])){
    if($_POST["qte"] && $_POST["prix"]){
        $prod = $_POST["prod"];
        $four = $_POST["four"];
        $qte = $_POST["qte"];
        $prix = $_POST["prix"];
        
        $que_insert = "insert into achat (ref_fourni, ref_produit, qte_achat, prix_achat) values (" . $four . ", " . $prod . ", " . $qte . ", " . $prix . ")";
        if(mysqli_query($con, $que_insert)){
            echo '<script type="text/javascript">
                $(document).ready(function(){
                  swal({
                    position: "top-end",
                    type: "success",
                    title: "Votre Commande est Enregistre avec Success!",
                    showConfirmButton: false,
                    timer: 5000
                  })
                });
             </script>';
        }
        
    }
}
?>


		<div class="container col-md-12" style="padding-top: 5%;">
			<div>
				<div class="row">
					<div class="container col-md-4 col-md-offset-4">
						<button class="btn btn-outline-secondary form-control" data-toggle="modal" data-target=".bd-example-modal-lg">Passer Une Commande</button>
					</div>
				</div><br><br>
				<div class="row">
					<div class="col-md-6">
    					<label style="color: blue; font-size: 20px; padding-left: 100px;"><?php echo "Nombre des Transactions Effectue est " . mysqli_num_rows($rs_que) . " d'Achats." ?></label>
    				</div>
    				<div class="col-md-6">
    				<?php while ($et_Achat_TTC = mysqli_fetch_assoc($rs_Achat_TTC)){ ?>
        				<strong><label style="color: black; font-size: 20px;">Les Achats Effectue durant ces Commandes le TTC : <span style="color: blue; font-size: 22px;"><?php echo $et_Achat_TTC["TTC"] . " Dhs" ?></span></label></strong>
        			<?php } ?>
    			</div>
    			</div><br>
				<table class="table table-hover">
					<tr class="thead-light">
						<th style="width: 160px;">Titre d'Article</th> 
						<th>Designation</th> 
						<th style="width: 180px;">Categorie</th> 
						<th style="width: 170px;">Fournisseur</th> 
						<th>Quantite (Unite)</th> 
						<th style="width: 100px;">Prix d'Achat (DH)</th> 
						<th style="width: 100px;">Prix TTC (Q * P)</th>
						<th>Image</th>
						<th>Date Achat</th>
					</tr> 
					<?php while ($et_que = mysqli_fetch_assoc($rs_que)){ ?>	
					<?php $que_img = "select * from photo where ref_produit = " . $et_que["ref_Produit"] . " order by ref_photo desc limit 1" ; ?>
					<?php $rs_img = mysqli_query($con, $que_img); ?>
					
					<tr>
						<td><?php echo $et_que["titre"] ?></td>
						<td><?php echo $et_que["descrip"] ?></td> 
						<td><?php echo $et_que["descrip_cat"] ?></td> 
						<td><?php echo $et_que["nom"] . "  " . $et_que["prenom"] ?></td> 
						<td style="text-align: center;"><?php echo $et_que["qte_achat"] ?></td> 
						<td style="text-align: center;"><?php echo $et_que["prix_achat"] ?></td>
						<td style="width: 100px; text-align: center;"><?php echo $et_que["qte_achat"] * $et_que["prix_achat"] ?>
						<td>
							<?php while ($et_img = mysqli_fetch_assoc($rs_img)){ ?>
								<img src="<?php echo "img/" . $et_img["photo"] ?>" width="60"></td>
							<?php } ?>
						<td style="width: 120px;"><?php echo $et_que["date_achat"] ?></td> 
					</tr> 
					<?php } ?>
				</table>
			</div><br><br>
		</div><br><br><br>
		
		<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        	<div class="modal-dialog modal-lg">
            	<div class="modal-content">
                 	<div class="modal-header" style="text-align: center;">
                    	<h5 class="modal-title" id="exampleModalLabel">Passer Une Commande  </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        	<span aria-hidden="true">&times;</span>
                        </button>
                   	</div>
                    <form action="" method="post">
                    	<div class="modal-body">
                        	<div class="row">
                        		<div class="col-md-6">
                        			<label>Fournisseur</label>
                        			<select class="form-control" name="four" required="required">
                        				<?php while ($et_four = mysqli_fetch_assoc($rs_four)){ ?>
                        					<option value="<?php echo $et_four["ref_client"] ?>"><?php echo $et_four["nom"] . "  " . $et_four["prenom"] ?></option>
                        				<?php } ?>
                        			</select>
                        		</div>
                        		<div class="col-md-6">
                        			<label>Produit</label>
                        			<select class="form-control" name="prod" required="required">
                        				<?php while ($et_prod = mysqli_fetch_assoc($rs_prod)){ ?>
                        					<option value="<?php echo $et_prod["ref_Produit"] ?>"><?php echo $et_prod["titre"] . "  -  " . $et_prod["descrip_cat"] ?></option>
                        				<?php } ?>
                        			</select>
                        		</div>
                        	</div><br> 
                        	<div class="row">
                        		<div class="col-md-6">
                        			<label>Quantite Commander</label>
                        			<input type="number" name="qte" class="form-control" min="0" required="required">
                        		</div>
                        		<div class="col-md-6">
                        			<label>Prix d'Achat</label>
                        			<input type="number" name="prix" class="form-control" min="0" required="required">
                        		</div>
                        	</div><br> 
                        </div> 
                        <div class="modal-footer">
                        	<div class="container col-md-12">
                             	<div class="row">
                                	<div class="col-md-6">
                                   		<button type="button" class="btn btn-secondary" data-dismiss="modal" style="width: 100%;">Annuler</button>
                                   	</div>
                                  	<div class="col-md-6">
                                  		<button type="submit" name="valider" class="form-control btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Valider</button>
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
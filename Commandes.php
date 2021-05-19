<?php

require_once 'DB.php';
require_once 'headerAdmin.php';

$query = "select * from commande c, produit p, users u where c.ref_produit = p.ref_Produit and c.ref_client = u.ref_client";
$rs_query = mysqli_query($con, $query);

$que_TTC = "SELECT SUM(c.qte_com * p.prix_vente) as TTC from commande c, produit p WHERE p.ref_Produit = c.ref_produit and c.etat_commande = 1";
$rs_TTC = mysqli_query($con, $que_TTC);
?>

		<div class="container col-md-12" style="padding-top: 5%;">
			<div class="row">
				<div class="col-md-6">
    				<label style="color: blue; font-size: 20px; padding-left: 100px;"><?php echo "Nombre des Commandes " . mysqli_num_rows($rs_query) . "." ?></label>
    			</div>
    			<div class="col-md-6">
    				<?php while ($et_TTC = mysqli_fetch_assoc($rs_TTC)){ ?>
        				<strong><label style="color: black; font-size: 20px;">Les Ventes Effectue durant ces Commandes le TTC : <span style="color: blue; font-size: 22px;"><?php echo $et_TTC["TTC"] . " Dhs" ?></span></label></strong>
        			<?php } ?>
    			</div>
    		</div><br>
			<table class="table table-hover">
				<tr class="thead-light">
					<th style="width: 180px;">Client</th> 
					<th>Produit</th> 
					<th>Image</th>
					<th style="width: 200px;">Quantite Commande</th> 
					<th>Prix * Quantite</th>
					<th style="width: 150px;">Date Commande</th> 
					<th style="width: 150px; text-align: center;">Etat</th> 
					<th></th> 
				</tr> 
				<?php while ($et = mysqli_fetch_assoc($rs_query)){ ?>
				<?php $que_img = "select * from photo where ref_produit = " . $et["ref_Produit"] . " order by ref_photo desc limit 1"; ?>
				<?php $rs_img = mysqli_query($con, $que_img); ?>
				<tr>
					<td><?php echo $et["nom"] . "  " . $et["prenom"] ?></td> 
					<td><?php echo $et["descrip"] ?></td> 
					<td>
						<?php while ($et_img = mysqli_fetch_assoc($rs_img)){ ?>
							<img src="<?php echo "img/" . $et_img["photo"] ?>" width="50">
						<?php } ?>
					</td> 
					<td style="text-align: center;"><?php echo $et["qte_com"] ?></td> 
					<td><?php echo $et["prix_vente"] * $et["qte_com"] ?></td>
					<td style="text-align: center;"><?php echo $et["date_com"] ?></td>
					<td style="color: white;">
						<?php if($et["etat_commande"] == "Null" || $et["etat_commande"] == ""){ ?>
							<a class="btn btn-info" style="width: 150px;">en Attente..</a>
						<?php } elseif ($et["etat_commande"] == 0) { ?>
							<a class="btn btn-danger" style="width: 150px;">Annuler</a>
						<?php } else { ?>
							<a class="btn btn-success" style="width: 150px;">Valider</a>
						<?php } ?>
					</td> 
					<td style="color: white;">
						<?php if($et["etat_commande"] == 1){ ?>
							<a></a>
						<?php } else { ?>
							<a href="comm_etat.php?ref=<?php echo $et["ref_commande"] ?>&st=<?php echo $et["etat_commande"] ?>" class="btn btn-success" style="width: 150px;">Valider</a>
						<?php } ?>
					</td> 
				</tr>
				<?php } ?>
			</table><br><br>
		</div><br><br><br><br><br>
	</body>
</html>
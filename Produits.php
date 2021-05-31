<?php


//if(!empty($_SESSION["role"]) && $_SESSION["role"] == "Opticien"){
    require_once 'redirectionIndex.php';
    require_once 'out.php';
    require 'DB.php';
    
    require_once 'headerAdmin.php';

    $query = "select * from produit p, categorie c where c.ref_cat = p.ref_cat order by p.ref_Produit desc";
    $rs = mysqli_query($con, $query);

?> 

		<div class="" style="padding-top: 6%;">
    			<div class="container col-md-12">
    				<form action="" method="post">
    					<div class="row" style="padding-left: 350px; padding-right: 350px;">
            				<div class="col-md-9">
            					<input type="text" placeholder="Search .." name="motcle" class="form-control">
            				</div>
            				<div class="col-md-3">
            					<input type="submit" class="btn btn-primary form-control" value="Search">
            				</div>
        				</div><br><br>
    				</form>
    			<div class="row">
    				<label style="color: blue; font-size: 20px; padding-left: 100px;"><?php echo "Nombre du Produits " . mysqli_num_rows($rs) . "." ?></label>
    			</div><br>
				<table class="table table-hover table-sm" id="sortTable">
					<tr class="thead-light">
						<th>Categorie</th> 
						<th>Description</th> 
						<th style="width: 140px;">Quantite Stocke</th> 
						<th>Prix du Vente</th>
						<th>Reserve</th> 
						<th>Type</th> 
						<th>Taille</th>
						<th>Photo</th>
						<th></th> 
						<th></th> 
						<th></th>
					</tr>
					<?php while ($et = mysqli_fetch_assoc($rs)){ ?>
					<tr>
						<td style="width: 120px;"><?php echo $et["descrip_cat"] ?></td> 
						<td><?php echo $et["descrip"] ?></td> 
						<td style="text-align: center;">
							<?php if( $et["qte_stocke"] > 1 ){ ?>
								<?php echo $et["qte_stocke"] ?>
							<?php } else { ?>
								<?php echo "<strong style='color:red;'>" . $et["qte_stocke"] . "</strong>" ?>
							<?php } ?>
						</td> 
						<td style="width: 120px; text-align: center;"><?php echo $et["prix_vente"] ?></td> 
						<td><?php echo $et["pour"] ?></td> 
						<td style="width: 150px;"><?php echo $et["type"] ?></td> 
						<td><?php echo $et["largeur"] ?></td>
						<?php $que_img = "select * from photo where ref_produit = " . $et["ref_Produit"] . " order by ref_photo desc limit 1"; ?>
						<?php $rs_img = mysqli_query($con, $que_img); ?>
						<?php while ($et_img = mysqli_fetch_assoc($rs_img)){ ?>
							<td><img src="<?php echo "img/" . $et_img["photo"] ?>" width="60"></td>
						<?php } ?>
						<td><a href="detailProduit.php?ref=<?php echo $et["ref_Produit"] ?>" class="btn btn-info form-control">Detail</a></td>
						<td><a href="updateProduit.php?ref=<?php echo $et["ref_Produit"] ?>" class="btn btn-success form-control">Modifier</a></td> 
						<td>
							<a href="deleteProduit.php?ref=<?php echo $et["ref_Produit"] ?>" class="btn btn-outline-danger form-control">Supprimer</a>
						</td>
					</tr>
					<?php  } ?>
				</table><br><br>
			</div>
		</div>
	</body><br><br><br>
</html>


<?php

require_once 'redirectionIndex.php';
require_once 'out.php';
require_once 'DB.php';
require_once 'headerAdmin.php';

$search = "";
if(isset($_GET["s"])){
    $search = $_GET["s"];
    $query = "select * from produit p, categorie c, promotion pro where c.ref_cat = p.ref_cat and pro.ref_produit = p.ref_Produit and (p.titre like '%" . $search . "%' or c.descrip_cat like '%" . $search . "%' or p.descrip like '%" . $search . "%') order by date_fin desc";
}
else {
    $query = "select * from produit p, categorie c, promotion pro where c.ref_cat = p.ref_cat and pro.ref_produit = p.ref_Produit order by date_fin desc";
}
$rs_query = mysqli_query($con, $query);

?> 
		<style>
            
        </style>
		<form action="" method="get" style="padding-top: 5%;">
    		<div class="row">
    			<div class="container col-md-6 col-md-offset-3">
  					<div class="row">
   						<div class="col-md-8">
    						<input type="text" placeholder="Search .." name="s" class="form-control" value="<?php echo $search ?>">
    					</div>
  						<div class="col-md-4">
    						<input type="submit" value="Search" class="form-control btn btn-info"> 
    					</div>
 					</div>
    			</div>
    		</div><br><br><br>
		</form>
		<div class="row">
    		<label style="color: blue; font-size: 20px; padding-left: 100px;"><?php echo "Nombre des Resultats trouve est " . mysqli_num_rows($rs_query) . " des Promotions." ?></label>
   		</div><br>
		<div class="container col-md-12" >
			<?php if(mysqli_num_rows($rs_query) != 0){ ?>
    			<table class="table table-hover">
    				<tr class="thead-light">
    					<th style="width: 120px;">Titre</th> 
    					<th style="width: 160px;">Categorie</th> 
    					<th>Description</th> 
    					<th style="width: 100px;">Prix TTC (en Dh)</th> 
    					<th>Prix (en Remise)</th>
    					<th>Remise (en %)</th>
    					<th>Duree</th> 
    					<th style="width: 120px;">Date Lancement</th> 
    					<th style="width: 120px;">Date Expiration</th> 
    					<th>Statut</th> 
    					<th>Photo d'Article</th>
    					<th></th> 
    					<th></th>  
    				</tr> 
    				<?php while ($et = mysqli_fetch_assoc($rs_query)){ ?>
    					<?php if($et["date_fin"] > date("Y-m-d H:i:s")){ ?>
            				<tr>
            					<td><?php echo $et["titre"] ?></td> 
            					<td><?php echo $et["descrip_cat"] ?></td> 
            					<td style="width: 400px; font-size: 14px;"><?php echo $et["descrip"] ?></td> 
            					<td style="text-align: center;"><?php echo $et["prix_vente"] ?></td> 
            					<td style="text-align: center;"><?php echo $et["prix_promo"] ?></td> 
            					<td style="text-align: center;"><?php echo $et["remise"] ?></td> 
            					<td style="text-align: center;"><?php echo $et["duree"] ?></td> 
            					<td><?php echo $et["date_debut"] ?></td> 
            					<td><?php echo $et["date_fin"] ?></td> 
            					<td style="width: 90px;">
                					<?php if($et["date_fin"] > date("Y-m-d H:i:s")){ ?>
                						<a class="btn btn-success" style="color: white; width: 100px;">Disponible</a>
                					<?php } else { ?>
                						<a class="btn btn-warning" style="color: white; width: 100px;">Expiree</a>
                					<?php } ?>
            					</td>
            					<?php $que_img = "select * from photo where ref_produit = " . $et["ref_Produit"] . " order by ref_photo desc limit 1"; ?>
                				<?php $rs_img = mysqli_query($con, $que_img); ?>
                				<?php if(mysqli_num_rows($rs_img) != 0){ ?>
                					<?php while ($et_img = mysqli_fetch_assoc($rs_img)){ ?>
            							<td><img src="<?php echo "img/" . $et_img["photo"] ?>" width="60"></td>
            						<?php } ?>
            					<?php } else { ?>
            						<td></td>
            					<?php } ?>
            					<?php if($et["date_fin"] > date("Y-m-d H:i:s")){ ?>
            						<td><a href="#" class="btn btn-info">Modifier</a></td> 
            					<?php } else { ?>
            						<td></td> 
            					<?php } ?>
            					<td><a href="#" class="btn btn-outline-danger">Annuler</a></td>
            				</tr>
            			<?php } else { ?>
            				<tr class="alert alert-warning">
            					<td><?php echo $et["titre"] ?></td> 
            					<td><?php echo $et["descrip_cat"] ?></td> 
            					<td style="width: 400px; font-size: 14px;"><?php echo $et["descrip"] ?></td> 
            					<td style="text-align: center;"><?php echo $et["prix_vente"] ?></td> 
            					<td style="text-align: center;"><?php echo $et["prix_promo"] ?></td> 
            					<td style="text-align: center;"><?php echo $et["remise"] ?></td> 
            					<td style="text-align: center;"><?php echo $et["duree"] ?></td> 
            					<td><?php echo $et["date_debut"] ?></td> 
            					<td><?php echo $et["date_fin"] ?></td> 
            					<td style="width: 90px;">
                					<?php if($et["date_fin"] > date("Y-m-d H:i:s")){ ?>
                						<a class="btn btn-success" style="color: white; width: 100px;">Disponible</a>
                					<?php } else { ?>
                						<a class="btn btn-warning" style="color: white; width: 100px;">Expiree</a>
                					<?php } ?>
            					</td>
            					<?php $que_img = "select * from photo where ref_produit = " . $et["ref_Produit"] . " order by ref_photo desc limit 1"; ?>
                				<?php $rs_img = mysqli_query($con, $que_img); ?>
                				<?php if(mysqli_num_rows($rs_img) != 0){ ?>
                					<?php while ($et_img = mysqli_fetch_assoc($rs_img)){ ?>
            							<td><img src="<?php echo "img/" . $et_img["photo"] ?>" width="60"></td>
            						<?php } ?>
            					<?php } else { ?>
            						<td></td>
            					<?php } ?>
            					<?php if($et["date_fin"] > date("Y-m-d H:i:s")){ ?>
            						<td><a href="#" class="btn btn-info">Modifier</a></td> 
            					<?php } else { ?>
            						<td></td> 
            					<?php } ?>
            					<td><a href="#" class="btn btn-outline-danger">Annuler</a></td>
            				</tr>
            			<?php } ?>
    				<?php } ?>
    			</table>
    		<?php } else { ?>
    			<?php echo '<div class="alert alert-info" style="width:100%; text-align:center;">(0) Promotion Pour Cette Recherche { ' . $search . ' }</div>' ?>
    		<?php } ?>
		</div><br><br><br>
	</body><br><br>
</html>
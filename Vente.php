<?php

//if(!empty($_SESSION["role"]) && $_SESSION["role"] == "Opticien"){
    require_once 'redirectionIndex.php';
    require_once 'out.php';
    require_once 'DB.php';
    require_once 'headerAdmin.php';
    
    $search = "";
    if(isset($_GET["s"])){
        $search = $_GET["s"];
        $que = "select * from commande co, users u, produit p, categorie c where c.ref_cat = p.ref_cat and p.ref_Produit = co.ref_produit and co.ref_client = u.ref_client and (p.titre like '%" . $search . "%' or p.descrip like '%" . $search . "%' or c.descrip_cat like '%" . $search . "%' or u.nom like '%" . $search . "%' or u.prenom like '%" . $search . "%') order by date_com desc";
    }
    else {
        $que = "select * from commande co, users u, produit p, categorie c where c.ref_cat = p.ref_cat and p.ref_Produit = co.ref_produit and co.ref_client = u.ref_client order by date_com desc";
    }
    $rs_que = mysqli_query($con, $que);
?> 


		<div class="container col-md-12" style="padding-top: 5%;">
			<div>
				<form action="" method="get">
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
            		<label style="color: blue; font-size: 20px; padding-left: 100px;"><?php echo "Nombre des Transactions Effectue est " . mysqli_num_rows($rs_que) . " du Vente." ?></label>
            	</div><br>
            	<?php if(mysqli_num_rows($rs_que) != 0){ ?>
    				<table class="table table-hover">
    					<tr class="thead-light">
    						<th>Titre d'Article</th> 
    						<th>Designation</th> 
    						<th>Categorie</th> 
    						<th>Client</th> 
    						<th>Quantite (Unite)</th> 
    						<th style="width: 120px;">Prix du Vente (DH)</th>
    						<th style="width: 100px;">Prix TTC (Q * P)</th>
    						<th>Image</th>
    						<th>Date Vente</th> 
    					</tr> 
    					<?php while ($et_que = mysqli_fetch_assoc($rs_que)){ ?>	
    					<?php $que_img = "select * from photo where ref_produit = " . $et_que["ref_Produit"] . " order by ref_photo desc limit 1" ; ?>
    					<?php $rs_img = mysqli_query($con, $que_img); ?>
    					
    					<tr>
    						<td style="width: 150px;"><?php echo $et_que["titre"] ?></td>
    						<td><?php echo $et_que["descrip"] ?></td> 
    						<td><?php echo $et_que["descrip_cat"] ?></td> 
    						<td><?php echo $et_que["nom"] . "  " . $et_que["prenom"] ?></td> 
    						<td><?php echo $et_que["qte_com"] ?></td> 
    						<td style="width: 120px;"><?php echo $et_que["prix_vente"] ?></td>
    						<td style="width: 100px;"><?php echo $et_que["qte_com"] * $et_que["prix_vente"] ?>
    						<td>
    							<?php while ($et_img = mysqli_fetch_assoc($rs_img)){ ?>
    								<img src="<?php echo "img/" . $et_img["photo"] ?>" width="60"></td>
    							<?php } ?>
    						<td style="width: 120px;"><?php echo $et_que["date_com"] ?></td> 
    					</tr> 
    					<?php } ?>
    				</table>
    			<?php } else { ?>
    				<?php echo '<div class="alert alert-info" style="width:100%; text-align:center;">(0) Produits Pour Cette Recherche { ' . $search . ' }</div>' ?>
    			<?php } ?>
			</div><br><br><br><br><br>
		</div>
	</body>
</html>




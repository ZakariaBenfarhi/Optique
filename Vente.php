<?php

//if(!empty($_SESSION["role"]) && $_SESSION["role"] == "Opticien"){

    require_once 'DB.php';
    require_once 'headerAdmin.php';
    
    
    
    $que = "select * from commande co, users u, produit p, categorie c where c.ref_cat = p.ref_cat and p.ref_Produit = co.ref_produit and co.ref_client = u.ref_client order by date_com desc";
    $rs_que = mysqli_query($con, $que);
?> 


		<div class="container col-md-12" style="padding-top: 5%;">
			<div>
				<div class="row">
            		<label style="color: blue; font-size: 20px; padding-left: 100px;"><?php echo "Nombre des Transactions Effectue est " . mysqli_num_rows($rs_que) . " du Vente." ?></label>
            	</div><br>
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
			</div>
		</div>
	</body>
</html>



<?php
//if(!empty($_SESSION["role"]) && $_SESSION["role"] == "Opticien"){
    require_once 'DB.php';
    require_once 'headerAdmin.php';

    
    $cli = $_GET["cli"];
    
    $que_comm = "select * from users u, produit p, categorie cat, commande c where p.ref_cat = cat.ref_cat and c.ref_client = u.ref_client and p.ref_Produit = c.ref_produit and u.ref_client = " . $cli . " order by date_com desc";
    $rs_comm = mysqli_query($con, $que_comm);       
    
?> 

		<div class="container col-md-10 col-md-offset-1" style="padding-top: 5%;">
			<?php if(mysqli_num_rows($rs_comm) != 0){ ?>
    			<table class="table table-hover">
    				<tr class="thead-light"> 
    					<th style="width: 130px;">L'Article</th> 
    					<th>Categorie</th> 
    					<th>Designation</th>
    					<th>Quantite Commander</th> 
    					<th>Prix</th> 
    					<th>Avance</th> 
    					<th>Reste</th> 
    					<th style="width: 130px;">Date</th>
    				</tr> 
    					<?php while ($et_comm = mysqli_fetch_assoc($rs_comm)){ ?>
    						<?php if($et_comm["prix_vente"] - $et_comm["avance"] == 0){ ?>
            				<tr class=""> 
            					<td style="width: 160px;"><?php echo $et_comm["titre"] ?></td>
            					<td><?php echo $et_comm["descrip_cat"] ?></td>
            					<td><?php echo $et_comm["descrip"] ?></td>
            					<td><?php echo $et_comm["qte_com"] ?></td>
            					<td><?php echo $et_comm["prix_vente"] ?></td>
            					<td><?php echo $et_comm["avance"] ?></td>
            					<td style="color: green;"><strong><?php echo $et_comm["prix_vente"] - $et_comm["avance"] ?></strong></td>
            					<td style="width: 130px;"><?php echo $et_comm["date_com"] ?></td>
            				</tr>
            				<?php } else{ ?>
            				<tr class="alert alert-warning"> 
            					<td style="width: 160px;"><?php echo $et_comm["titre"] ?></td>
            					<td><?php echo $et_comm["descrip_cat"] ?></td>
            					<td><?php echo $et_comm["descrip"] ?></td>
            					<td><?php echo $et_comm["qte_com"] ?></td>
            					<td><?php echo $et_comm["prix_vente"] ?></td>
            					<td><?php echo $et_comm["avance"] ?></td>
            					<td style="color: red;"><strong> <?php echo $et_comm["avance"] - $et_comm["prix_vente"] ?></strong></td>
            					<td style="width: 130px;"><?php echo $et_comm["date_com"] ?></td>
            				</tr>
            				<?php } ?>
            			<?php } ?>
    			</table>
    		<?php } else { ?>
    			<div class="alert alert-info" role="alert" style="text-align: center; font-size: 20px; height: 70px; padding-top: 20px;">Cet Client n'as Aucune Transaction pour le Moment !</div>
    		<?php } ?>
		</div>
	</body> 
</html>



<?php
//if(!empty($_SESSION["role"]) && $_SESSION["role"] == "Opticien"){
    require_once 'DB.php';
    require_once 'headerAdmin.php';
    
    
    $ref = $_GET["ref"];
    
    $cc = 0;
    $query = "select * from produit p, categorie c where c.ref_cat = p.ref_cat and p.ref_Produit = " . $ref;
    $rs_query = mysqli_query($con, $query);
    
    
    
    $que_img = "select * from photo where ref_produit = " . $ref;
    $rs_img = mysqli_query($con, $que_img);
    
    $count_img = mysqli_num_rows($rs_img);

?> 

		<div style="padding-top: 5%;">
			<div class="container col-md-6 col-md-offset-3">
				<?php while ($et_query = mysqli_fetch_assoc($rs_query)){ ?>
					<div class="card">
						<div class="card-header"><?php echo $et_query["titre"] ?></div>
						<div class="card-body">					
        					<div class="group-form" style="">
            					<div class="row">
            							<div class="col-md-6">
            								<label>Ref d'Article : <?php echo $et_query["ref_Produit"] ?></label>
            							</div>
            							<div class="col-md-6">
            								<label>Categorie : <?php echo $et_query["descrip_cat"] ?></label>
            							</div>
            					</div><br>
            					<div class="row">
            						<div class="col-md-6">
            							<label>Prix d'Article : <?php echo $et_query["prix_vente"] ?></label>
            						</div>
            						<div class="col-md-6">
           								<label>Quantite en Stocke : <?php echo $et_query["qte_stocke"] ?></label>
           							</div>
           						</div><br>
           						<?php if(!empty($et_query["type"]) && !empty($et_query["largeur"])){ ?>
               						<div class="row">
               							<div class="col-md-6">
               								<label>Type du Lunette : <?php echo $et_query["type"] ?></label>
               							</div>
               							<div class="col-md-6">
               								<label>Largeur du Lunette : <?php echo $et_query["largeur"] ?></label>
               							</div>
               						</div><br>
           						<?php } elseif (!empty($et_query["ref_lentille"]) && !empty($et_query["type_lentille"])){ ?>
               						<div class="row">
               							<div class="col-md-6">
               								<label>Ref du Lentille : <?php echo $et_query["ref_lentille"] ?></label>
               							</div>
               							<div class="col-md-6">
               								<label>Type du Lentille : <?php echo $et_query["type_lentille"] ?></label>
               							</div>
               						</div><br>
           						<?php } ?>
           						<div class="row">
           							<div class="col-md-12">
           								<label>Categorie Concerne : <?php echo $et_query["pour"] ?></label><br>
           							</div>
           						</div><br>
           						<div class="row">
           							<div class="col-md-12">
           								<label>Description : </label><br> 
           								<label><?php echo $et_query["descrip"] ?></label>
           							</div>
           						</div>
        					</div>
						</div>
					</div>
				<?php } ?>
			</div><br><br> 
		</div><br>
	</body>
</html>


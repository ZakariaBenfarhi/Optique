<?php
//if(!empty($_SESSION["role"]) && $_SESSION["role"] == "Opticien"){
    require_once 'redirectionIndex.php';
    require_once 'out.php';
    require_once 'DB.php';
    require_once 'headerAdmin.php';
    
    if(!empty($_GET["ref"]) && isset($_GET["ref"])){
        $ref = $_GET["ref"];
        
        $cc = 0;
        $query = "select * from produit p, categorie c where c.ref_cat = p.ref_cat and p.ref_Produit = " . $ref;
        $rs_query = mysqli_query($con, $query);
        
        
        
        function make_query($con) {
            $ref = $_GET["ref"];
            $query_pic = "select pi.* from photo pi, panier p where p.ref_produit = pi.ref_produit and p.ref_produit = " . $ref;
            $rs_pic = mysqli_query($con, $query_pic);
            return $rs_pic;
        }
        
        function make_slide_indicators($con) {
            $output = '';
            $count = 0;
            $result = make_query($con);
            while ($row = mysqli_fetch_array($result)) {
                if($count == 0){
                    $output .= '<li data-target="#dynamic_slide_show" data-slide-to="'.$count.'" class="active"></li>';
                }
                else {
                    $output .= '<li data-target="#dynamic_slide_show" data-slide-to="'.$count.'"></li>';
                }
                $count = $count + 1;
            }
            return $output;
        }
        
        function make_slides($con) {
            $output = '';
            $count = 0;
            $result = make_query($con);
            while($row = mysqli_fetch_array($result))
            {
                if($count == 0)
                {
                    $output .= '<div class="item active">';
                }
                else
                {
                    $output .= '<div class="item">';
                }
                $output .= '<img src="img/'.$row["photo"].'" width="70%" height="200" align="center" /> </div>';
                $count = $count + 1;
            }
            return $output;
        }
        
    }
?> 
		<?php if(isset($_GET["ref"]) && !empty($_GET["ref"])){ ?>
        	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
        	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <?php } ?>
		<div style="padding-top: 3%;">
			<div class=" container col-md-6 col-md-offset-3">
        		<div id="dynamic_slide_show" class="carousel slide" data-ride="carousel">
                   	<ol class="carousel-indicators">
                      	<?php echo make_slide_indicators($con); ?>
                    </ol>
    				<div class="carousel-inner" align="center">
                     	<?php echo make_slides($con); ?>
                    </div>
                    <a class="left carousel-control" href="#dynamic_slide_show" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                       	<span class="sr-only">Previous</span>
                    </a>
                    
                   	<a class="right carousel-control" href="#dynamic_slide_show" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                     	<span class="sr-only">Next</span>
                 	</a>
              	</div>
            </div> 
			<div class="container col-md-6 col-md-offset-3" style="padding-top: 3%;">
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
					</div><br><br><br><br><br><br><br><br><br><br><br><br> 
				<?php } ?>
			</div><br><br><br><br> 
		</div><br><br><br>
	</body>
</html>


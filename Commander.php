<?php

//if(!empty($_SESSION["role"]) && $_SESSION["role"] == "Opticien"){
    require_once 'redirectionIndex.php';
    require_once 'out.php';
    require_once 'DB.php';
    require_once 'headerAdmin.php';
    
    $client = $_GET["cli"];
    
    $query_prod = "select ref_Produit, titre, qte_stocke from produit ";
    $rs_query_prod = mysqli_query($con, $query_prod);
    
    
    if(isset($_POST["valider"])){
        
        $prod = $_POST["prod"];
        $qte = $_POST["qte"];
        $avance = $_POST["avance"];
        
        if(!empty($client) && !empty($prod) && !empty($qte) && !empty($avance)){
            $query = "insert into commande (ref_client, ref_produit, qte_com, avance) values (" . $client . ", " . $prod . ", " . $qte . ", " . $avance . ")";
            if(mysqli_query($con, $query)){
                echo '<script type="text/javascript">
                        $(document).ready(function(){
                          swal({"Good job!", "You clicked the button!", "success"}, 5000)
                        });
                      </script>';
            }
        }
    }

?>
		<div class="container col-md-4 col-md-offset-4" style="padding-top: 5%;">
    		<div class="card ">
    			<div class="card-header">Passer Une Commande</div>
    			<form action="" method="post">
    				<div class="card-body">
            			<div class="modal-body">
                          	<div class="group-form">
                                <input type="hidden" name="client" value="<?php echo $ref_client ?>">
                              	<div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                    	<span class="input-group-text" id="basic-addon1" style="width: 100px">L'Article :</span>
                                    </div>
                  					<select name="prod" class="form-control">
                                    	<?php while ($et_query_prod = mysqli_fetch_assoc($rs_query_prod)){ ?>
                                    		<option value="<?php echo $et_query_prod["ref_Produit"] ?>"><?php echo $et_query_prod["titre"] ?></option>
                                    	<?php } ?>
                                  	</select> 											
                  				</div><br><br>
                               	<div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                    	<span class="input-group-text" id="basic-addon1" style="width: 100px">Quantite :</span>
                                    </div>
                  					<input type="number" name="qte" min="1" class="form-control" required="required">	
                  				</div><br><br> 
                  				<div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                    	<span class="input-group-text" id="basic-addon1" style="width: 100px">Avance :</span>
                                    </div>
                  					<input type="text" name="avance" class="form-control" required="required" value="0">	
                  				</div><br><br>
                          	</div>
                        </div>
                    	<div class="card-footer">
                    		<div class="row">
                    			<div class="col-md-6">
                    				<button type="button" class="btn btn-secondary form-control">Annuler</button>
                    			</div>
                    			<div class="col-md-6">
                    				<button type="submit" class="btn btn-primary form-control" name="valider">Valider</button>
                    			</div>
                    		</div>
                       	</div>
                  	</div> 	
              	</form>	
        	</div> 
       	</div><br><br><br><br>



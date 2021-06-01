<?php
//if(!empty($_SESSION["role"]) && $_SESSION["role"] == "Opticien"){
    require_once 'redirectionIndex.php';
    require_once 'out.php';
    require_once 'DB.php';
    require_once 'headerAdmin.php';
    
    $search = "";
    if(isset($_GET['s'])){
        $search = $_GET['s'];
        $query = "select * from users where role = 'Client' and ( nom like '%". $search ."%' or prenom like '%" . $search . "%' or sexe like '%" . $search . "%' or email like '%" . $search . "%' or telephone like '%" . $search . "%' or adresse like '%" . $search . "%' or ville like '%" . $search . "%' or couv_medi like '%" . $search . "%' ) order by ref_client desc";
    }
    else {
        $query = "select * from users where role = 'Client' order by ref_client desc";
    }
    $rs = mysqli_query($con, $query);



?> 

		<div class="container col-md-10 col-md-offset-1" style="padding-top: 5%;">
			<form action="" method="get">
    			<div class="row" style="padding-left: 350px; padding-right: 350px;">
            		<div class="col-md-9">
            			<input type="text" placeholder="Search .." name="s" class="form-control" value="<?php echo $search ?>">
            		</div>
          			<div class="col-md-3">
            			<input type="submit" class="btn btn-primary form-control" value="Search">
          			</div>
       			</div><br><br>
       		</form> 
    		<div class="row">
        			<label style="color: blue; font-size: 20px; padding-left: 20px;"><?php echo "Nombre de Resultat Trouve est " . mysqli_num_rows($rs) . " Clients." ?></label>
        	</div><br>
    		<table class="table table-hover">
    			<tr class="thead-light">
   					<th>Nom</th>
   					<th>Prenom</th>
   					<th>E-mail</th>
   					<th>Telephone</th>
    				<th>Photo</th>
    				<th>Status</th>
    				<th>Transaction</th>
    				<th>Commander</th> 
    			</tr>
   				<?php while ($et = mysqli_fetch_assoc($rs)){ ?>
   				<tr> 
   					<td><?php echo $et["nom"] ?></td>
   					<td><?php echo $et["prenom"] ?></td>
    				<td><?php echo $et["email"] ?></td>
    				<td><?php echo $et["telephone"] ?></td>
    				<td><img src="<?php echo 'img/' . $et["img"] ?>" width="50px"></td>
    				<td>
       					<?php if($et["status"] == 1){ ?>
       						<a href="status.php?status=1&ref=<?php echo $et["ref_client"] ?>" class="btn btn-success" style="color: white;">Enabled</a>
       					<?php } else { ?>
       						<a href="status.php?status=0&ref=<?php echo $et["ref_client"] ?>" class="btn btn-danger" style="color: white;">Disabled</a>
       					<?php } ?>
       				</td>
   					<td><a href="lesCommandesClient.php?cli=<?php echo $et["ref_client"] ?>" class="btn btn-info" style="color: white;">Ses Achats</a></td>   				
    				<td>
    					<?php if($et["status"] == 1){ ?>
    						<a href="Commander.php?cli=<?php echo $et["ref_client"] ?>" class="btn btn-primary" style="color: white;">Commander</a>
    					<?php } ?>
    				</td>
    			</tr>
   				<?php } ?>
   			</table>
		</div><br><br><br>
	</body><br><br><br>
</html>


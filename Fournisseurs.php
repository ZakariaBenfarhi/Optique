<?php
require_once 'DB.php';
require_once 'headerAdmin.php';


$query = "select * from users where role = 'Fournisseur' order by ref_client desc";
$rs = mysqli_query($con, $query);
?> 

		<div class="container col-md-10 col-md-offset-1" style="padding-top: 5%;">
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
    			<label style="color: blue; font-size: 20px; padding-left: 20px;"><?php echo "Nombre de Resultat Trouve est " . mysqli_num_rows($rs) . " Fournisseurs." ?></label>
    		</div><br>
			<table class="table table-hover">
				<tr class="thead-light">
					<th>Nom</th>
					<th>Prenom</th>
					<th>E-mail</th>
					<th>Telephone</th>
					<th>Photo</th>
					<th>Status</th>
					<th></th>
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
					<td>
						<?php if($et["status"] == 1){ ?>
							<a href="Commander.php?ref=<?php echo $et["ref_client"] ?>" class="btn btn-info">Passer Une Commande</a>
						<?php } ?>	
					</td>
				</tr>
				<?php } ?>
			</table>
		</div><br><br><br><br><br>
	</body> 
</html>


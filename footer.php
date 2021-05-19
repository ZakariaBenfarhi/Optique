<?php

require_once 'DB.php';

if(isset($_POST["env"])){
    $nom = $_POST["nom"];
    $tele = $_POST["tele"];
    $msg = $_POST["msg"];
    $email = $_POST["email"];
    
    $nom_rep = str_replace("'", "\'", $nom);
    $tele_rep = str_replace("'", "\'", $tele);
    $msg_rep = str_replace("'", "\'", $msg);
    $email_rep = str_replace("'", "\'", $email);
    
    $query = "insert into report (Nom, Email, tele, msg) values ('" . $nom_rep . "', '" . $email_rep . "', '" . $tele_rep . "', '" . $msg_rep . "')";
    if(mysqli_query($con, $query)){
        echo '<script type="text/javascript">
                $(document).ready(function(){
                  swal({
                    position: "top-end",
                    type: "success",
                    title: "Votre Message est Envoye avec Success! Notre Support sera vous contactera dans les Prochaines 48 Heures.",
                    showConfirmButton: false,
                    timer: 5000
                  })
                });
             </script>';
    }
}
?> 

    	<style type="text/css">
    	   .vl {
                  border-left: 1px solid black;
                  height: 420px;
               
                  position: absolute;
                  left: 50%;
                  margin-left: -3px;
                  top: 50px;
            }
    	</style>
	
		<div class="" style="width: 100%">
			<div class="">
				<div class="card bg-dark" style="height: 520px; width: 100%;">
					<div class="card-body">
						<div class="row">
							<div class="col-sm-6 col-sm-offset-1">
								<div style="color: white; font-size: 25px; text-align: center; color: threedshadow; font-weight: bold; font-style: italic; font-family: fantasy;">
									Optique Shop
    							</div><br>
    							<div>
    								<h6 style="color: white;"> Optic Shop est une Entreprise qui a été crée en 2021 par Mme KAMAR Salma et Mr BENFARHI Zakaria qui se basé à Casablanca Maarif, qu'est une nouvelle génération 100%, qui permet aux consommateurs de réserver et de consulter notre cabinet et sans obligation d'achat leurs lunettes de vue, Soleil, ou bien les lentilles, Nous sommes là pour garantir leur santé visuelle.</h6>
    							</div><br><br>
    							<div style="color: white; text-align: center; font-size: 18px;">Nous Sommes Disponibles sur :</div><br>
    							<div class="row" style="padding-left: 5%;">
    								<div class="col">
    									<a href="#"><span style="color: white;"><img src="./assets/fb.ico" width="30px"><?php echo "&nbsp;&nbsp;" ?>Optique Shop</span></a>
    								</div>
    								<div class="col">
    									<a href="#"><span style="color: white;"><img src="./assets/ig.ico" width="30px"><?php echo "&nbsp;&nbsp;" ?>Optique Shop</span></a>
    								</div>
    							</div><br>
    							<div class="row" style="padding-left: 5%;">
    								<div class="col">
    									<a href="#"><span style="color: white;"><img src="./assets/mail.ico" width="30px"><?php echo "&nbsp;&nbsp;" ?>Conatct@OptiqueShop.ma</span></a>
    								</div>
    								<div class="col">
    									<a href="#"><span style="color: white;"><img src="./assets/phone.ico" width="30px"><?php echo "&nbsp;&nbsp;" ?>(+212) 522 404 404 / (+212) 522 343 908</span></a>
    								</div>
    							</div><br>
    							<div class="row" style="padding-left: 5%;">
    								<div class="col">
    									<a href="#"><span style="color: white;"><img src="./assets/localisation.ico" width="30px"><?php echo "&nbsp;&nbsp;" ?>3ème étage 529 maarif devant McDonnald - Casablanca</span></a>
    								</div>
    							</div><br>
							</div>
							<div class="vl"></div>
    						<div class="col-sm-6" style="padding-left: 3%; padding-right: 3%;">
    							<div style="color: white; text-align: center; font-size: 18px;">Des Questions ou Demandes ? Ecrivez-nous ! </div><br><br>
<    							<form action="" method="post"> 
    								<div class="row">
        								<div class="col-6">
        									<input type="text" name="nom" placeholder="Nom de Contact" class="form-control" required="required" maxlength="30">
        								</div>
            							<div class="col-6">
            								<input type="text" name="tele" placeholder="Téléphone" class="form-control" required="required" maxlength="10">
            							</div>
        							</div><br><br>	
        							<div class="">
        								<input type="email" name="email" class="form-control" placeholder="Email" required="required" maxlength="50">
        							</div><br><br>
        							<div class="">
        								<textarea name="msg" class="form-control" placeholder="Votre Message" required="required" maxlength="300"></textarea>
        							</div><br><br> 
        							<input type="submit" value="Envoyer" name="env" class="btn btn-primary form-control" >
		   						</form>
    						</div>	 
						</div>
					</div>
					<div>
						<h5 style="text-align: center; color: white;">CopyRight © 2021</h5>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>




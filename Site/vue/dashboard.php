<html lang="fr">
  <head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1"/>
	<title>Dashboard</title>
	<link rel="stylesheet" href="dashboard.css">
	<link rel="stylesheet" href="ui.colorpicker.css"/>
	<script language="JavaScript" src="jQuery.js"></script>
	<script language="JavaScript" src="jQuery.colorpicker.js"></script>
  </head>
  <body>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>LumHome</title>
    </head>
    <body>
<nav class="banner">
		<div class="vert-align">
			<a href="./accueil.html">
				<img src="./resources/logo.png" class="logo vert-align" alt="Logo LumHome">
			</a>
		</div>

		<div class="container">            
			<div class="buttonLog">
				<a href="mod_infos.html" class="vert-align">
					<img src="./resources/logo_user.png" class="logoa" alt="User_Account">
					<span class="button_desc">Mon Compte</span>
				</a>
			</div>

			<div class="buttonLog">
				<a href="accueil.html" class="vert-align">
					<img src="./resources/logo_disconnect.png" class="logoa" alt="Disconnect">
					<span class="button_desc">Déconnexion</span>
				</a>
			</div>
		</div>
	</nav>
	<nav class="menuu">
		<div class="vert-align">
			<div class="menuButton">
				<a href="./dashboard.html" class="vert-align">
					<img src="./resources/logo_disconnect.png" class="logoa" alt="Disconnect">
					<div class="button_desc_fromMenu">Accueil</div>
				</a>
			</div>    
		</div>
		<div class="vert-align">
			<div class="menuButton">
				<a href="gerer_sc.html" class="vert-align">
					<img src="./resources/logo_disconnect.png" class="logoa" alt="Disconnect">
					<span class="button_desc_fromMenu">Scénario</span>
				</a>
			</div>    
		</div>
		<div class="vert-align">
			<div class="menuButton">
				<a href="./gerer.html" class="vert-align">
					<img src="./resources/logo_disconnect.png" class="logoa" alt="Disconnect">
					<span class="button_desc_fromMenu">Gérer</span>
				</a>
			</div>    
		</div>
		<div class="vert-align">
			<div class="menuButton">
				<a href=# class="vert-align">
					<img src="./resources/logo_disconnect.png" class="logoa" alt="Disconnect">
					<span class="button_desc_fromMenu">Statistiques</span>
				</a> 
			</div>    
		</div>
		<div class="vert-align notif">
			<div class="notification">
				<a href="">
					<img src="./resources/notification.png" class="logo_notif" alt="Alertes">
					<img src="./resources/nb_notif.png" class="logo_notif" alt="Nb Alertes">
				</a>
			</div>
			
		</div>
	</nav>

    <body2>
        <h1>Accueil</h1>
    </body2>
	
</html>
				<div class="LeftContainer">
					<div class="entete_leftcontainer"> Pièces allumées <img src="./resources/fleche.png" class = "fleche"> </div>
					<div class="pieceallume"> Tous (3) 					
					<label class="switch">
  					<input type="checkbox">
  					<span class="slider round"></span>
					</label></div>
					<div class="pieceallume"> Salle à manger 					
					<label class="switch">
  					<input type="checkbox">
  					<span class="slider round"></span>
					</label></div>
					<div class="pieceallume"> Cuisine 					
					<label class="switch">
  					<input type="checkbox">
  					<span class="slider round"></span>
					</label></div>
					<div class="pieceallume"> Chambre 					
					<label class="switch">
  					<input type="checkbox">
  					<span class="slider round"></span>
					</label></div>
				</div>
		<div class="dashboard">
			<div class="RightContainer">
				<div class="habitation">
					<form>
						<select class="selecthabitation" name="habitation">
							<option value="Habitation 1">Habitation 1</option>
							<option value="Habitation 2">Habitation 2</option>
						</select>
					</form>
				</div>

				<?php include '../modele/afficherPieceScenario.php'?>
			</div>
		</div>
	</body>
</html>

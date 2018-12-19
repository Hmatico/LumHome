<html lang="fr">
  <head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1"/>
	<title>Dashboard</title>
	<link rel="stylesheet" href="hello.css">
	<link rel="stylesheet" href="ui.colorpicker.css"/>
	<script language="JavaScript" src="jQuery.js"></script>
	<script language="JavaScript" src="jQuery.colorpicker.js"></script>
    </head>
    <body>
	<?php include "entete.html";?>
	<div class = "dhabitatprincipal">
		<div class="dleftcontainer">
			<div class="dhabitatactuel">
				<form method="post" action="">
					<select class = "dselecthabitat">
					   <option value="france">Habitation 1(principal)</option>
					   <option value="espagne">Habitation 2</option>
				   </select>
				</form>
			</div>
			<div class="dtteteindre">
				<div class="dtxteteindre"> Tout éteindre</div>
				<label class="switch"><input type="checkbox" checked><span class="slider round"></span></label>
			</div>
		</div>
		<div class="drightcontainer">
			<div class ="ligne">
				<div class="detatpiece">Piece : <a class = "detat"> état </a></div>
				<div class="detatpiece">Piece : <a class = "detat"> état </a></div>
				<div class="detatpiece">Piece : <a class = "detat"> état </a></div>
				<div class="detatpiece">Piece : <a class = "detat"> état </a></div>
				<div class="detatpiece">Piece : <a class = "detat"> état </a></div>
				<div class="detatpiece">Piece : <a class = "detat"> état </a></div>
			</div>
			<div class ="ligne">
				<div class="detatpiece">Piece : <a class = "detat"> état </a></div>
				<div class="detatpiece">Piece : <a class = "detat"> état </a></div>
				<div class="detatpiece">Piece : <a class = "detat"> état </a></div>
				<div class="detatpiece">Piece : <a class = "detat"> état </a></div>
				<div class="detatpiece">Piece : <a class = "detat"> état </a></div>
				<div class="detatpiece">Piece : <a class = "detat"> état </a></div>
			</div>
			<div class ="ligne">
				<div class="detatpiece">Piece : <a class = "detat"> état </a></div>
				<div class="detatpiece">Piece : <a class = "detat"> état </a></div>
				<div class="detatpiece">Piece : <a class = "detat"> état </a></div>
				<div class="detatpiece">Piece : <a class = "detat"> état </a></div>
				<div class="detatpiece">Piece : <a class = "detat"> état </a></div>
				<div class="detatpiece">Piece : <a class = "detat"> état </a></div>
			</div>
		</div>
	</div>
	<div class ="scenario">
			<div class="Piece">
						<div class="Entete_piece"> Chambre de David </div>
						<div class="contenu_piece">
							<div class="leftpiece"> 
								<div class="div_colorpicker"><input type="color" class="colorpicker"></div>
								<div class="texte_couleur">Couleur</div>
							</div>
							<div class="rightpiece">
							<img src="./resources/soleil.png" class = "soleil"><br><a class="texteluminosite">Luminosité</a>
							</div>
							<div><input class="piecerange" type="range"/>
								<div class="texte_intensite">Intensité</div></div>

						</div>
	</div>
  </div>
</body>
</html>
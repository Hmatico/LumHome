<html lang="fr">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>Accueil</title>
		<link rel="stylesheet" href="adios.css">
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
			<div class="dentetepiece"> Piece </div>
			<div class="dcorppiece">
				<div class="dafficherscenario"> <button class="dbuttonafficherscenario" type="button"> Afficher les scénarios</button></div>
				<div class="dcorppiece1">
					<div class="dcouleur">
						<div class="div_colorpicker"><input type="color"  value="#ffffff" class="colorpicker"></div>
					</div>
					<div class="dluminosite">
						<img src="./resources/soleil.png" class = "soleil">
					</div>
				</div>
				<div class="dcorppiece1">
					<div class="dcouleur">
						<div class="texte_couleur">#777777</div>
					</div>
					<div class="dluminosite">
						<div class="texteluminosite">220 lux</div>
					</div>
				</div>
				<div class="div_dpiecerange">
					<input type="range" class="dslider">
				</div>
				<div class="div_dtxtluminosite">
					<div class="dtxtluminosite"> 50%</div>
				</div>
			</div>
		</div>
	</body>
</html>
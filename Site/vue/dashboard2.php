<html lang="fr">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>Accueil</title>
		<link rel="stylesheet" href="dashboard2.css">
	</head>
	<body>
		<img class="triche2" src="./resources/triche2.png"/> 
		<div class = "dhabitatprincipal">
			<div class="dleftcontainer">
				<div class="dhabitatactuel">
					<form method="post">
						<select class = "dselecthabitat" id="dselecthabitat" onchange="afficherEtatPiece()">
					   </select>
					</form>
				</div>
				<div class="dtteteindre">
					<div class="dtxteteindre"> <button class="btntteteindre" type="button">Tout eteindre</button> </div>
				</div>
			</div>
			<div id="drightcontainer">
			</div>
		</div>
		<div class = "fake_dhabitatprincipal"></div>
					<div class="dentetepiece"> Pieces </div>
		<div class ="scenario">
		</div>
		<script type="text/javascript" src="./javaScript/dashboard.js"></script>
	</body>
</html>
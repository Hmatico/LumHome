<?php 
	include '../modele/connexionBD.php';
	$i = 3;	
	$tab=" ";
	$piece = "";
	$req= "select piece.nom,scenario,scenario_cemac.* from `scenario_cemac` inner join `scenario` inner join piece where `scenario_cemac`.`fk_scenario` = `scenario`.`nom`";	
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : "). $req .'\n'.mysqli_error($link)); 		
	while($tab = mysqli_fetch_assoc($res))
		{
		if($i%3==0)$piece = $piece."<div class=\"Line\">";
		$piece = $piece."<div class=\"Piece\"> <div class=\"Entete_piece\">".$tab['fk_scenario']." </div> <div class=\"contenu_piece\"> <div class=\"leftpiece\"><div class=\"div_colorpicker\"><input type=\"color\" class=\"colorpicker\"></div>";
		$piece = $piece."<div class=\"texte_couleur\">#".$tab['valeurCouleur']."</div>"."<input class=\"piecerange\" type=\"range\"/><div class=\"texte_intensite\">".$tab['valeurIntensite']."%</div></div>";
		$piece = $piece."<div class=\"rightpiece\"><img src=\"./resources/soleil.png\" class = \"soleil\"><br><a class=\"texteluminosite\"></a></div></div></div>"; // Rajouter Intensité quand la bdd sera clean
		if($i%3==2)$piece = $piece."</div>";
	$i++;
	}
	echo $piece;
?>
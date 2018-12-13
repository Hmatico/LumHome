<?php 
	include '../modele/connexionBD.php';
	$req= "select * from `scenario_cemac` inner join `scenario` where `scenario`.`nom`=`scenario_cemac`.`fk_scenario`";	
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : "). $req .'\n'.mysqli_error($link)); 
	$tab = mysqli_fetch_assoc($res);
	$piece = "<div class=\"Piece\"> <div class=\"Entete_piece\">".$tab['scenario']." </div> <div class=\"contenu_piece\"> <div class=\"leftpiece\"><div class=\"div_colorpicker\"><input type=\"color\" class=\"colorpicker\"></div>";
        $piece = $piece."<div class=\"texte_couleur\">#".$tab['valeurCouleur']."</div>"."<input class=\"piecerange\" type=\"range\"/><div class=\"texte_intensite\">".$tab['valeurIntensite']."%</div></div>";
	$piece = $piece."<div class=\"rightpiece\"><img src=\"./resources/soleil.png\" class = \"soleil\"><br><a class=\"texteluminosite\">Luminosité</a></div></div></div>";
	echo $piece;
?>
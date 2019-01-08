<?php 
	include '../modele/connexionBD.php';
	$i = 1;	
	$tab=" ";
	while($tab!="")
	{
		$req= "select `numeroSerie` from `cemac` inner join `piece` where `cemac`.`fk_piece`=".$i;	
		$res = mysqli_query($link, $req)	
			or die (utf8_encode("erreur de requête : "). $req .'\n'.mysqli_error($link)); 
		$tab = mysqli_fetch_assoc($res);
		$req= "select * from `scenario_cemac` where `scenario_cemac`.`fk_CeMAC` = \"".$tab['numeroSerie']."\"";	
		$res = mysqli_query($link, $req)	
			or die (utf8_encode("erreur de requête : "). $req .'\n'.mysqli_error($link)); 		
		$tab = mysqli_fetch_assoc($res);
		if($tab=="") break;
		$piece="";
		if($i%2==1)$piece = $piece."<div class=\"Line\">";
		$piece = $piece."<div class=\"Piece\"> <div class=\"Entete_piece\">".$tab['fk_scenario']." </div> <div class=\"contenu_piece\"> <div class=\"leftpiece\"><div class=\"div_colorpicker\"><input type=\"color\" class=\"colorpicker\"></div>";
		$piece = $piece."<div class=\"texte_couleur\">#".$tab['valeurCouleur']."</div>"."<input class=\"piecerange\" type=\"range\"/><div class=\"texte_intensite\">".$tab['valeurIntensite']."%</div></div>";
		$piece = $piece."<div class=\"rightpiece\"><img src=\"./resources/soleil.png\" class = \"soleil\"><br><a class=\"texteluminosite\">Luminosité</a></div></div></div>";
		if($i%2==0)$piece = $piece."</div>";
		echo $piece;
		$i++;
	}

?>
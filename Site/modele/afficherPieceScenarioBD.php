<?php 
	include '../modele/connexionBD.php';
	$i = 3;	
	$tab=" ";
	$piece = "";
	if (isset($_POST['habitatselect'])) {
		$req= 'select * from cemac inner join piece WHERE cemac.fk_piece = piece.idPiece and fk_habitat = '.$_POST['habitatselect'];
	}
	else $req= 'select * from cemac inner join piece WHERE cemac.fk_piece = piece.idPiece and fk_habitat = 1';
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : "). $req .'\n'.mysqli_error($link)); 		
	while($tab = mysqli_fetch_assoc($res))
		{
		if($i%3==0)$piece = $piece."<div class=\"Line\">";
		$piece = $piece."<div class=\"Piece\"> <div class=\"Entete_piece\">".$tab['nom']." </div> <div class=\"contenu_piece\"> <div class=\"leftpiece\"><div id=\"couleur".$tab['fk_piece']."\" class=\"div_colorpicker\"><input type=\"color\" oninput=\"ModifierCouleur()\" class=\"colorpicker\"></div>";
		$piece = $piece."<div class=\"texte_couleur\">#".$tab['couleur']."</div>"."<input id=\"intensite".$tab['fk_piece']."\" class=\"piecerange\"  oninput=\"ModifierIntensite()\" type=\"range\"/><div class=\"texte_intensite\">".$tab['intensite']."%</div></div>";
		$piece = $piece."<div class=\"rightpiece\"><img src=\"./resources/soleil.png\" class = \"soleil\"><br><a class=\"texteluminosite\"></a></div></div></div>"; // Rajouter Intensité quand la bdd sera clean
		if($i%3==2)$piece = $piece."</div>";
	$i++;
	}
	echo $piece;
?>
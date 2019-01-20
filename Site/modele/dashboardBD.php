<?php

	function GetEtatPiece(){
		require("modele/connexionBD.php");
		$i = 6;
		$piece = "";
		$finligne=0;
		$req = 'SELECT cemac.etat,piece.nom,piece.type from piece inner join cemac on piece.idPiece = cemac.fk_piece where piece.fk_habitat='.$_POST['habitatselect'] ;
		$res = mysqli_query($link, $req)
			or die (utf8_encode("")); 
		while($tab = mysqli_fetch_assoc($res))
		{
			if($i%6==0)$piece = $piece.'<div class ="ligne">';
			$piece = $piece.'<div class="detatpiece"><div class=';
			if($tab['etat']==0)$piece = $piece.'"etatpieceeteint"';
			else $piece = $piece.'"etatpieceallume"';
			$piece = $piece.'></div>'.$tab['nom'].'<a class = "detat">'.$tab['type'].'</a></div>';
			if($i%6==5)
			{
				$piece = $piece.'</div>';
				$finligne=1;
			}		
			else $finligne=0;
			$i++;
		}
		if($finligne = 1) $piece = $piece.'</div>';
		return $piece;
	}

	function GetHabitat(){
		require("modele/connexionBD.php");
		$habitat = "";
		$i=1;
		$req= "select `nomHabitat` from `habitat`";
		$res = mysqli_query($link, $req)		
			or die (utf8_encode("")); 
		while($tab = mysqli_fetch_assoc($res))
		{
			$habitat = $habitat.'<option value = "'.$i.'">'.$tab['nomHabitat'];
			$habitat = $habitat.'</option>';
		$i++;
		}
		return $habitat;
	}
	
	function EteindreHabitat(){
		require("modele/connexionBD.php");
		$req= 'UPDATE `cemac` inner join `piece` SET `etat` = 0 WHERE cemac.fk_piece = piece.idPiece and fk_habitat = '.$_POST['habitatselect'];
		$res = mysqli_query($link, $req)	
			or die (utf8_encode(""));
	}
	
	function GetPieceScenario(){
		require("modele/connexionBD.php");
		$i = 3;	
		$piece = "";
		if($_POST['habitatselect']=="0")return $piece;
		else 
		{
			$req= 'select cemac.intensite,cemac.couleur,piece.nom,cemac.fk_piece from cemac inner join piece on piece.idPiece = cemac.fk_piece where piece.fk_habitat = '.$_POST['habitatselect'];
			$res = mysqli_query($link, $req)	
				or die (utf8_encode("erreur de requête : "). $req .'\n'.mysqli_error($link));
			while($tab = mysqli_fetch_assoc($res))
			{
				$nom = $tab['nom'];
				$couleur = $tab['couleur'];
				$intensite = $tab['intensite'];
				$idpiece = $tab['fk_piece'];
				if($i%3==0)$piece = $piece."<div class=\"Line\">";
				$piece = $piece."<div class=\"Piece\"> <div class=\"Entete_piece\">".$nom." </div> <div class=\"contenu_piece\"> <div class=\"leftpiece\"><div class=\"div_colorpicker\"><input type=\"color\" onchange=\"ModifierCouleur(this.id)\" value=\"#".$couleur."\" class=\"colorpicker\" id = \"".$idpiece."\"></div>";
				$piece = $piece."<div class=\"texte_couleur\">#".$couleur."</div><input class=\"piecerange\" min=\"0\" max=\"100\" id = \"".$idpiece."\" value=\"".$intensite."\" type=\"range\"/><div class=\"texte_intensite\">".$intensite."%</div></div>";
				$piece = $piece."<div class=\"rightpiece\"><img src=\"./resources/soleil.png\" class = \"soleil\"><br><a class=\"texteluminosite\"></a></div></div></div>"; // Rajouter Intensité quand la bdd sera clean
				if($i%3==2)$piece = $piece."</div>";
				$i++;
			}
			return $piece;
		}
	}
	
	function ChangerCouleur(){
		require("modele/connexionBD.php");
	$req= 'UPDATE `cemac` SET `couleur` ='.$_POST['couleur'].' WHERE cemac.fk_piece = piece.idPiece and fk_habitat = '.$_POST['habitatselect'];
		$res = mysqli_query($link, $req)	
			or die (utf8_encode(""));
		
	}
?>

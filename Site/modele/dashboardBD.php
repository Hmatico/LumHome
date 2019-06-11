<?php

	function GetEtatPiece(){
		require("modele/connexionBD.php");
		$i = 6;
		$piece = "";
		$finligne=0;
		$req = 'SELECT cemac.etat,piece.nom,piece.type,piece.idPiece from piece inner join cemac on piece.idPiece = cemac.fk_piece where piece.fk_habitat='.$_POST['habitatselect'] ;
		$res = mysqli_query($link, $req)
			or die (utf8_encode("")); 
		while($tab = mysqli_fetch_assoc($res))
		{
			if($i%6==0)$piece = $piece.'<div class ="ligne">';
			$piece = $piece.'<div class="detatpiece"><div onclick=\"ModifierEtatPiece(this.id)\" class=';
			if($tab['etat']==0)$piece = $piece.'"etatpieceeteint"';
			else $piece = $piece.'"etatpieceallume"';
			$piece = $piece.'></div>'.$tab['nom'].'<a class = "detat" >'.$tab['type'].'</a></div>';
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
		$req= "select `nomHabitat`,`idHabitat` from `habitat` where fk_proprietaire = \"".$_SESSION['user']."\"";
		$res = mysqli_query($link, $req)	
			or die (utf8_encode("")); 
		while($tab = mysqli_fetch_assoc($res))
		{
			$habitat = $habitat.'<option value = "'.$tab['idHabitat'].'">'.$tab['nomHabitat'];
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
			$req= 'select cemac.intensite,cemac.couleur,piece.nom,cemac.fk_piece,cemac.type,cemac.etat from cemac inner join piece on piece.idPiece = cemac.fk_piece where piece.fk_habitat = '.$_POST['habitatselect'];
			$res = mysqli_query($link, $req)	
				or die (utf8_encode(""));
			while($tab = mysqli_fetch_assoc($res))
			{
				$nom = $tab['nom'];
				$couleur = $tab['couleur'];
				$intensite = $tab['intensite'];
				$idpiece = $tab['fk_piece'];
				$type = $tab['type'];
				$etat = $tab['etat'];
				if($i%3==0)$piece = $piece."<div class=\"Line\">";
				if($type=="ampoule")
				{
				$piece .= "<div class=\"Piece\"> <div class=\"Entete_piece\">".$nom." (".$type.")"." </div> <div class=\"contenu_piece\"> <div class=\"leftpiece\"><div class=\"div_colorpicker\"><input type=\"color\" onchange=\"ModifierCouleur(this.id)\" value=\"#".$couleur."\" class=\"colorpicker\" id = \"color000".$idpiece."\"></div>";
				$piece .= "<div class=\"texte_couleur\">#".$couleur."</div><input onchange=\"ModifierIntensite(this.id)\" class=\"piecerange\" min=\"0\" max=\"100\" id = \"intensite000".$idpiece."\" value=\"".$intensite."\" type=\"range\"/><div class=\"texte_intensite\">".$intensite."%</div></div>";
				$piece .= "<div class=\"rightpiece\"><img src=\"./resources/soleil.png\" class = \"soleil\"><br><a class=\"texteluminosite\"></a></div></div></div>"; // Rajouter Intensite quand la bdd sera clean
				}
				if($type=="moteur")
				{
					$piece .= "<div class=\"Piece\"> <div class=\"Entete_piece\">".$nom." (".$type.")"." </div>"; // Entete
					$piece .= "<div class=\"contenu_piece\"><div class=\"leftpiece\">";// Partie gauche
					if($etat==1)
					{
						$piece .= "<div class=div_colorpicker>Etat : <input id=\"moteurid_000".$idpiece."\" onchange= \"ChangerEtatMoteur(this.id)\" type=\"checkbox\" checked></div></div>"; 
					}
					else
					{
						$piece .= "<div class=div_colorpicker>Etat : <input id=\"moteurid_000".$idpiece."\" onchange= \"ChangerEtatMoteur(this.id)\" type=\"checkbox\"></div></div>"; 
					}
					$piece .= "<div class=\"rightpiece\"><img src=\"./resources/store.png\" class = \"soleil\"><br><a class=\"texteluminosite\"></a></div></div></div>"; //Partie droite
				}
				if($i%3==2)$piece = $piece."</div>";
				$i++;
			}
			return $piece;
		}
	}
	
	function ChangerMoteur(){
		
		require("modele/connexionBD.php");
		
		if($_POST['etat'] == "0") $req= 'UPDATE `cemac` SET `etat` = 0 WHERE cemac.fk_piece ='.$_POST['piece'].' AND cemac.type="moteur"';
		else $req= 'UPDATE `cemac` SET `etat` = 1 WHERE cemac.fk_piece ='.$_POST['piece'].' AND cemac.type="moteur"';
		$res = mysqli_query($link, $req)
			or die (utf8_encode(""));
	}
	
	function ChangerCouleur(){
		
		require("modele/connexionBD.php");
		$couleur = substr($_POST['couleur'], -6);
		$req= 'UPDATE `cemac` SET `couleur` ="'.$couleur.'" WHERE cemac.fk_piece ='.$_POST['piece'].' AND cemac.type="ampoule"';
		$res = mysqli_query($link, $req)	
			or die (utf8_encode(""));
	}
	
	function ChangerIntensite(){
		require("modele/connexionBD.php");
		$couleur = substr($_POST['couleur'], 0, -1);
		$req= 'UPDATE `cemac` SET `intensite` ="'.$_POST['intensite'].'" WHERE cemac.fk_piece ='.$_POST['piece'].' AND cemac.type="ampoule"';
		$res = mysqli_query($link, $req)	
			or die (utf8_encode(""));
	}
?>

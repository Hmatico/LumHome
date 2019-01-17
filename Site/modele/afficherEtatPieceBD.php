<?php
	include '../modele/connexionBD.php';
	$i = 6;
	$piece = "";
	$adressemail="";
	$finligne=0;
	if (isset($_POST['habitatselect'])) {
		$req = 'select cemac.etat,piece.nom,scenario.type from cemac inner join scenario_cemac inner join scenario inner join piece where scenario_cemac.fk_CeMAC = cemac.numeroSerie and scenario_cemac.fk_scenario = scenario.nom and cemac.fk_piece = piece.idPiece and piece.fk_habitat ='.$_POST['habitatselect'];
	}
	else $req = 'select cemac.etat,piece.nom,scenario.type from cemac inner join scenario_cemac inner join scenario inner join piece where scenario_cemac.fk_CeMAC = cemac.numeroSerie and scenario_cemac.fk_scenario = scenario.nom and cemac.fk_piece = piece.idPiece and piece.fk_habitat = 1' ;
	$res = mysqli_query($link, $req)
		or die (utf8_encode("erreur de requête : "). $req .'\n'.mysqli_error($link)); 
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
	echo $piece;
?>
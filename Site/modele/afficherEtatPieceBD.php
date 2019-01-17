<?php
	include '../modele/connexionBD.php';
	$i = 6;
	$piece = "";
	$adressemail="";
	$finligne=0;
	if (isset($_POST['habitatselect'])) {
		$req = 'SELECT `piece`.`type`,`piece`.`nom`,`scenario`.`statut` FROM piece inner join scenario where fk_habitat = "'.$_POST['habitatselect'].'" AND piece.type=scenario.type' ;
	}
	else $req = 'SELECT `piece`.`type`,`piece`.`nom`,`scenario`.`statut` FROM `piece` inner join `scenario` where `fk_habitat` = 1  AND `piece`.`type`=`scenario`.`type`' ;
	$res = mysqli_query($link, $req)
		or die (utf8_encode("erreur de requête : "). $req .'\n'.mysqli_error($link)); 
	while($tab = mysqli_fetch_assoc($res))
	{
		if($i%6==0)$piece = $piece.'<div class ="ligne">';
		$piece = $piece.'<div class="detatpiece"><div class=';
		if($tab['statut']==0)$piece = $piece.'"etatpieceeteint"';
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
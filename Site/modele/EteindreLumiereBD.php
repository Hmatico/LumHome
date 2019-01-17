<?php
	include '../modele/connexionBD.php';
	$req= "UPDATE `SCENARIO` SET `statut` = 0";
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : "). $req .'\n'.mysqli_error($link));
?>
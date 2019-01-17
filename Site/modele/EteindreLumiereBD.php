<?php
	include '../modele/connexionBD.php';
	$req= 'UPDATE `cemac` inner join `piece` SET `etat` = 0 WHERE cemac.fk_piece = piece.idPiece and fk_habitat = '.$_POST['habitatselect'];
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : "). $req .'\n'.mysqli_error($link));
?>
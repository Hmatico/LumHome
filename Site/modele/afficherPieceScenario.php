<?php 
	include '../modele/connexionBD.php';

	$req= "select `scenario`.`scenario` from `scenario_cemac` inner join `scenario` where `scenario`.`nom`=`scenario_cemac`.`fk_scenario`";	
	$res = mysqli_query($link, $req)	
		or die (utf8_encode("erreur de requête : "). $req .'\n'.mysqli_error($link)); 
	$tab = mysqli_fetch_assoc($res);
	echo $tab['scenario'];
?>
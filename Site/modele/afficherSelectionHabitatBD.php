<?php
	$habitat = "";
	$i=1;
	include '../modele/connexionBD.php';
	$req= "select `nomHabitat` from `habitat`";
	$res = mysqli_query($link, $req)		
		or die (utf8_encode("erreur de requête : "). $req .'\n'.mysqli_error($link)); 
	while($tab = mysqli_fetch_assoc($res))
	{
		$habitat = $habitat.'<option value = "'.$i.'">'.$tab['nomHabitat'];
		$habitat = $habitat.'</option>';
	$i++;
	}
	echo $habitat;
?>
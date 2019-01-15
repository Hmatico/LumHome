<?php
	$link = new mysqli("localhost", "root", "", "base_lumhome");
	$i = 6;
	$piece = "";
	$fkhabitat=1;
	$finligne=0;
	
	$req = "select `nom` from `PIECE` where `PIECE`.`fk_habitat`=".$fkhabitat;	
	$res = mysqli_query($link, $req)
		or die (utf8_encode("erreur de requête : "). $req .'\n'.mysqli_error($link)); 
	while($tab = mysqli_fetch_assoc($res))
	{
		if($i%6==0)$piece = $piece.'<div class ="ligne">';
		$piece = $piece.'<div class="detatpiece"><div class="etatpiece"></div>'.$tab['nom'].'<a class = "detat"> ALLO </a></div>';
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
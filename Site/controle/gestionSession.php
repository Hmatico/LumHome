<?php
function ident(){
	$user= isset($_POST['user'])?($_POST['user']):'';
	$pswd= isset($_POST['pswd'])?($_POST['pswd']):'';
	$msgErr='';
	// $_SESSION['profil'] = array();
	if (count($_POST) == 0)
		require("vue/Accueil.tpl");
	else {
		require("modele/utilisateurBD.php");
		if(!(verifS($user, $pswd, $msgErr) && verif_bd($user, $pswd, $_SESSION['profil'], $_SESSION['role']))) {
			require ("vue/Accueil.tpl") ;
		}
		else { 
			if($_SESSION['profil']['id_user'] != ''){
				connect_user($_SESSION['profil']['id_user']);
				if($_SESSION['role'] == "etudiant")
				{	
					header("Location:index.php?controle=SessionEtudiant&action=bureauEleve");
				}	
				else if ($_SESSION['role'] == "prof")
						header("Location:index.php?controle=SessionProf&action=initSession");
					else require("vue/Accueil.tpl");
			} else {
				require("vue/Accueil.tpl");
			}	
		}	
	}
}
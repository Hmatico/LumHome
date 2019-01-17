<?php 

session_start();


if($_SESSION['user'] == ""){
    $controle = "gestionSession";
    $action=	"accueil";
} else {
    if ((count($_POST)!=0) && !(isset($_POST['controle']) && isset ($_POST['action'])))
		require ('./vue/error404.html'); //cas d'un appel à index.php avec des paramètres incorrects		
    else {
        if (!(isset($_SESSION['user'])) || count($_POST)==0)	{
            $controle = "gestionSession";   //cas d'une personne non authentifiée
            $action= "accueil";		//ou d'un appel à index.php sans paramètre
        }
        else {
            if (isset($_POST['controle']) && isset ($_POST['action'])) {
                $controle = $_POST['controle'];   //cas d'un appel à index.php 
                $action = $_POST['action'];	//avec les 2 paramètres controle et action
            }
        }
    }
}
require ('./controle/' . $controle . '.php');
$action ();

?>
<?php 

if ((count($_POST)!=0) && !(isset($_POST['controle']) && isset ($_POST['action'])))
    require ('./vue/accueil.html'); //cas d'un appel à index.php avec des paramètres incorrects	
else {
    isset($_POST['controle'])?$_POST['controle']:$_POST['controle']="gestionSession";
    isset($_POST['action'])?$_POST['action']:$_POST['action']="accueil";
    $controle = $_POST['controle'];   //cas d'un appel à index.php 
    $action = $_POST['action'];
    require ('./controle/' . $controle . '.php');
    $action (); 
}

?>
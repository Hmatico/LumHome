<?php

    function actif(){
        require("modele/utilisateurBD.php");
        echo nbActif();
    }

    function inactif(){
        require("modele/utilisateurBD.php");
        echo nbInactif();
    }

    function afficherCGU(){
        require("modele/adminBD.php");
        echo inputCGU();
    }

    function modifCGU(){
        $nb = count($_POST)/2;
        $parties = array();
        $textes = array();
        for($i = 1;$i < $nb ; $i ++){
            $tempP = "partie" . $i;
            $tempT = "texte" . $i;
            $parties[] = $_POST[$tempP];
            $textes[] = $_POST[$tempT];
        }
        require("modele/adminBD.php");
        echo modifierCGU($parties,$textes);
    }

?>
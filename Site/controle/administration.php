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

?>
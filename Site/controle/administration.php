<?php

    function actif(){
        require("modele/utilisateurBD.php");
        echo nbActif();
    }

    function inactif(){
        require("modele/utilisateurBD.php");
        echo nbInactif();
    }

?>
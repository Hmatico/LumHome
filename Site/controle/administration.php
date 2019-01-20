<?php

    function actif(){
        require("modele/utilisateurBD.php");
        echo nbActif();
    }

    function inactif(){
        require("modele/utilisateurBD.php");
        echo nbInactif();
    }

    function afficherFAQ(){
        require("modele/adminBD.php");
        echo inputFAQ();
    }

    function afficherCGU(){
        require("modele/adminBD.php");
        echo inputCGU();
    }

    function modifFAQ(){
        $nb = count($_POST)/2;
        $questions = array();
        $reponses = array();
        for($i = 1;$i < $nb ; $i ++){
            $tempQ = "question" . $i;
            $temR = "reponse" . $i;
            $questions[] = $_POST[$tempQ];
            $reponses[] = $_POST[$temR];
        }
        require("modele/adminBD.php");
        echo modifierFAQ($questions,$reponses);
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

    function deconnexion(){
        $_SESSION['user'] = "";
        $_SESSION['profil'] = "";
        session_destroy();
        require("vue/accueil.html");
    }

?>
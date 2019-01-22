<?php

    /**
    * Fonction retournant le nombre d'utilisateurs actif
    */
    function actif(){
        require("modele/utilisateurBD.php");
        echo nbActif();
    }

    /**
    * Fonction retournant le nombre d'utilisateurs inactif
    */
    function inactif(){
        require("modele/utilisateurBD.php");
        echo nbInactif();
    }

    /**
    * Fonction retournant les questions de la FAQ
    */
    function afficherFAQ(){
        require("modele/adminBD.php");
        echo inputFAQ();
    }

    /**
    * Fonction retournant les parties des CGU
    */
    function afficherCGU(){
        require("modele/adminBD.php");
        echo inputCGU();
    }

    /**
    * Fonction qui envoie les modifications de la FAQ
    */
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

    /**
    * Fonction qui envoie les modifications des CGU
    */
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

    /**
    * Fonction qui demande la déconnexion de l'administrateur
    */
    function deconnexion(){
        require("modele/adminBD.php");
        $return = decoAdmin($_SESSION['user'],false);
        $_SESSION['user'] = "";
        $_SESSION['profil'] = "";
        session_destroy();
        return $return;
    }

?>
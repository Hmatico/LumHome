<?php
/**
* Fonction retournant les questions de la FAQ
*/
function questions(){
    require("modele/accueilBD.php");
    echo getAllQuestions();
}

/**
* Fonction retournant les parties des CGU
*/
function getCGU(){
    require("modele/accueilBD.php");
    echo cgu();
}

/**
* Fonction retournant l'adresse mail de l'admin
*/
function getMail(){
    $nom = $_POST['nom'];
    $mail = $_POST['mail'];
    $obj = $_POST['obj'];
    $msg = $_POST['msg'];
    require("modele/accueilBD.php");
    echo mailAdmin($nom, $mail, $obj, $msg);
}
?>
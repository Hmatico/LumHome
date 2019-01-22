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

?>
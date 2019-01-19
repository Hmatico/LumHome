<?php

function questions(){
    require("modele/accueilBD.php");
    echo getAllQuestions();
}

function getCGU(){
    require("modele/accueilBD.php");
    echo cgu();
}

?>
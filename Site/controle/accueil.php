<?php

function questions(){
    require("modele/accueilBD.php");
    echo getAllQuestions();
}

?>
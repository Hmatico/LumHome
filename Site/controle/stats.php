<?php
    function dataStats(){
        include "modele/statsBD.php";
        echo getData();
    }
    
    function habitats(){
        include "modele/statsBD.php";
        echo getHabitats();
    }
?>
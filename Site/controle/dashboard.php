<?php

    function afficherEtatPiece(){
        require("modele/dashboardBD.php");
        echo GetEtatPiece();
    }
	
	function afficherPieceScenario(){
        require("modele/dashboardBD.php");
        echo GetPieceScenario();
    }
	
	function afficherSelectionHabitat(){
        require("modele/dashboardBD.php");
        echo GetHabitat();
    }	
	
	function ToutEteindre(){
        require("modele/dashboardBD.php");
        echo EteindreHabitat();
    }	
	
	function ModifierCouleur(){
        require("modele/dashboardBD.php");
        echo ChangerCouleur();
    }
	
	function ModifierMoteur(){
        require("modele/dashboardBD.php");
        echo ChangerMoteur();
    }
	
	function ModifierIntensite(){
        require("modele/dashboardBD.php");
        echo ChangerIntensite();
    }
	
	function ModifierEtatPiece(){
        require("modele/dashboardBD.php");
        echo ChangerEtatPiece();
    }
?>
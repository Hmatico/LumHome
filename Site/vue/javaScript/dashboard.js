function afficherEtatPiece(){
	var habitat = document.getElementById("dselecthabitat");
	var habitatselect = habitat.options[habitat.selectedIndex].value;
	var jsonData = $.ajax({
          url: "../modele/afficherEtatPieceBD.php",
          method : "POST",
          data: {habitatselect:habitatselect},
          dataType: "json",
          async: false,
    }).responseText;
	document.getElementById('drightcontainer').innerHTML = jsonData;
}

function ModifierCouleur(){
	alert("Tu as changé la couleur");
	var theInput = document.getElementsByClassName("colorpicker")[0].value;
   alert("La couleur est maintenant "+theInput);
	/*var jsonData = $.ajax({
          url: "../modele/afficherEtatPieceBD.php",
          method : "POST",
          data: {habitatselect:habitatselect},
          dataType: "json",
          async: false,
    }).responseText;*/
}

function ModifierIntensite(){
	alert("bonjour");
}

$('.btntteteindre').click(function(){
	var habitat = document.getElementById("dselecthabitat");
	var habitatselect = habitat.options[habitat.selectedIndex].value;
	alert(habitatselect);
	$.ajax({
          url: "../modele/EteindreLumiereBD.php",
          method : "POST",
          data: {habitatselect:habitatselect},	
          async: false,
    });
	$i = 0;
    $backgroundColor = window.getComputedStyle(document.getElementsByClassName('etatpieceallume')[0]).getPropertyValue('background-color');
	nbPiece = document.getElementsByClassName('etatpieceallume').length;
	for ($i = 0; $i < nbPiece; $i++) 
	{
		document.getElementsByClassName('etatpieceallume')[$i].style.background = "red";
	}
});
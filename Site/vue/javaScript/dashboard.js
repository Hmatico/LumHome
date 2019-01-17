$(document).ready(function(){ 

});	

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
$('.btntteteindre').click(function(){
	$i = 0;
    $backgroundColor = window.getComputedStyle(document.getElementsByClassName('etatpieceallume')[0]).getPropertyValue('background-color');
	nbPiece = document.getElementsByClassName('etatpieceallume').length;
	for ($i = 0; $i < nbPiece; $i++) 
	{
		document.getElementsByClassName('etatpieceallume')[$i].style.background = "red";
	}
	xhttp = new XMLHttpRequest();
	xhttp.open("POST", "../modele/EteindreLumiereBD.php", true);
	xhttp.send();
});

	/*$.ajax({
		url: '../modele/afficherEtatPiece.php',
		success: function(data){
			document.getElementById('drightcontainer').innerHTML = data;
		} 
    });*/

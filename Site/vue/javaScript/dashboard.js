$('.btntteteindre').click(function(){
	$i = 0;
    backgroundColor = window.getComputedStyle(document.getElementsByClassName('etatpiece')[0]).getPropertyValue('background-color');
	nbPiece = document.getElementsByClassName('etatpiece').length;
	for ($i = 0; $i < nbPiece; $i++) 
	{
		document.getElementsByClassName('etatpiece')[$i].style.background = "red";
	}
	xhttp = new XMLHttpRequest();
	xhttp.open("POST", "../modele/EteindreLumiere.php", true);
	xhttp.send();
});


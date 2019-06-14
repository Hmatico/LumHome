afficherSelectionHabitat();
majLog();

setInterval("majLog()",30000);

function afficherSelectionHabitat(){
	
	var controler = "controle=dashboard&action=afficherSelectionHabitat";
	var dataPOST = controler;
	$.ajax({
		type: "POST",
		url: "../index.php",
		data: dataPOST,
		success: function(data){
			document.getElementById('dselecthabitat').innerHTML = '<option value = "0">Choisir un habitat</option>'+data;
		},
	});
}

function majLog(){
    var controler = "controle=gateway&action=getLogs";
	var dataPOST = controler;
	$.ajax({
		type: "POST",
		url: "../index.php",
		data: dataPOST,
		success: function(data){
			alert("coucou");
		},
	});
}

$(".dselecthabitat").change(
	function ChangementHabitat(){
	
		var controler = "controle=dashboard&action=afficherEtatPiece";
		var habitat = document.getElementById("dselecthabitat");
		var habitatselect = "habitatselect="+habitat.options[habitat.selectedIndex].value;
		var dataPOST = controler+"&"+habitatselect;
		$.ajax({
			type: "POST",
			url: "../index.php",
			data: dataPOST,
			success: function(data){
				document.getElementById('drightcontainer').innerHTML = data;
			},
		});
		
		var controler = "controle=dashboard&action=afficherPieceScenario";
		var habitat = document.getElementById("dselecthabitat");
		var habitatselect = "habitatselect="+habitat.options[habitat.selectedIndex].value;
		var dataPOST = controler+"&"+habitatselect;
		$.ajax({
			type: "POST",
			url: "../index.php",
			data: dataPOST,
			success: function(data){
				if($piece="");
				else document.getElementsByClassName("scenario")[0].innerHTML = data;
			},
		});
	}
);

$('.btntteteindre').click(
	function ToutEteindre(){
		
		var controler = "controle=dashboard&action=ToutEteindre";
		var habitat = document.getElementById("dselecthabitat");
		var habitatselect = "habitatselect="+habitat.options[habitat.selectedIndex].value;
		var dataPOST = controler+"&"+habitatselect;
		$.ajax({
			type: "POST",
			url: "../index.php",
			data: dataPOST,
		});
		$nbPiece = document.getElementsByClassName('etatpieceallume').length;
		for ($i = 0; $i < $nbPiece; $i++) 
		{
			document.getElementsByClassName('etatpieceallume')[$i].style.background = "red";
		}
});

function ChangerEtatMoteur(clicked_id){
	
	var controler = "controle=dashboard&action=ModifierMoteur";
	var piece = "piece="+ clicked_id[clicked_id.length -4]+clicked_id[clicked_id.length -3]+clicked_id[clicked_id.length -2]+clicked_id[clicked_id.length -1];
	var etat = "";
	if (document.getElementById(clicked_id).checked)
	{
		etat = "etat=1";
		
	} else {
		etat = "etat=0";
	}
	var dataPOST = controler+"&"+piece+"&"+etat;
	alert(dataPOST);
	$.ajax({
		type: "POST",
		url: "../index.php",
		data: dataPOST,
	});
}

function ModifierEtatPiece(clicked_id){
	var controler = "controle=dashboard&action=ModifierEtatPiece";
	var piece = "piece="+clicked_id;
	var couleur = "couleur="+document.getElementById(clicked_id).style.getPropertyValue('background-color');
	alert(couleur);
	var dataPOST = controler+"&"+piece+"&"+couleur;
}

function ModifierCouleur(clicked_id){
	var controler = "controle=dashboard&action=ModifierCouleur";
	var piece = "piece="+ clicked_id[clicked_id.length -4]+clicked_id[clicked_id.length -3]+clicked_id[clicked_id.length -2]+clicked_id[clicked_id.length -1];
	var couleur = "couleur="+document.getElementById(clicked_id).value;
	var dataPOST = controler+"&"+piece+"&"+couleur;
	$.ajax({
		type: "POST",
		url: "../index.php",
		data: dataPOST,
	});
}

function ModifierIntensite(clicked_id){
	var controler = "controle=dashboard&action=ModifierIntensite";
	var piece = "piece="+clicked_id[clicked_id.length -4]+clicked_id[clicked_id.length -3]+clicked_id[clicked_id.length -2]+clicked_id[clicked_id.length -1];
	var intensite = "intensite="+document.getElementById(clicked_id).value;
	var dataPOST = controler+"&"+piece+"&"+intensite;
	$.ajax({
		type: "POST",
		url: "../index.php",
		data: dataPOST,
	});
}
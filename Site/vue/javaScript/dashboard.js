afficherSelectionHabitat();

update();

setInterval("update()",15000);

function update(){
	majLog();
	setTimeout("majData()",500);
}

function afficherSelectionHabitat(){
	
	var controler = "controle=dashboard&action=afficherSelectionHabitat";
	var dataPOST = controler;
	$.ajax({
		type: "POST",
		url: "../index.php",
		data: dataPOST,
		success: function(data){
			document.getElementById('dselecthabitat').innerHTML = '<option value = "0">Choisir un habitat</option>'+data;
		}
	});
}

function majLog(){
    var controler = "controle=gateway&action=getLogs";
	var dataPOST = controler;
	$.ajax({
		type: "POST",
		url: "../index.php",
		data: dataPOST
	});
}

function majData(){
    var controler = "controle=dashboard&action=RecupererInfos";
	var habitat = document.getElementById("dselecthabitat");
	var habitatselect = "habitatselect="+habitat.options[habitat.selectedIndex].value;
	var numeroSerie = "numeroSerie=\"A02B01\"";
	var numeroSerie2 = "numeroSerie=\"A02B02\"";
	var dataPOST = controler+"&"+habitatselect+"&"+numeroSerie;
		$.ajax({
			type: "POST",
			url: "../index.php",
			data: dataPOST,
			success: function(data){
                document.getElementById('intensite0001').value = data;
                $('#text_intensite0001').html(data+"%");
			}
		});
	var dataPOST = controler+"&"+habitatselect+"&"+numeroSerie2;
		$.ajax({
			type: "POST",
			url: "../index.php",
			data: dataPOST,
			success: function(data){
				document.getElementById('moteurid_0001').disabled = false;
				if(data == "0")
				{
				document.getElementById('moteurid_0001').checked = false;
				}
				else
				{
				document.getElementById('moteurid_0001').checked = true;
				}
			}
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
			}
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
			}
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
			data: dataPOST
		});
		$nbPiece = document.getElementsByClassName('etatpieceallume').length;
		for ($i = 0; $i < $nbPiece; $i++) 
		{
			document.getElementsByClassName('etatpieceallume')[$i].style.background = "red";
		}
});

function ChangerEtatMoteur(clicked_id){
	
	var controler = "controle=dashboard&action=ModifierMoteur";
	var controler2 = "controle=gateway&action=sendCommand";
	var trame = '';
	var piece = "piece="+ clicked_id[clicked_id.length -4]+clicked_id[clicked_id.length -3]+clicked_id[clicked_id.length -2]+clicked_id[clicked_id.length -1];
	var etat = "";
	if (document.getElementById(clicked_id).checked)
	{
		etat = "etat=1";
		trame = 'trame=1A02B1a04000165';
	} else {
		etat = "etat=0";
		trame = 'trame=1A02B1a04000065';
	}
	var dataPOST = controler+"&"+piece+"&"+etat;
	var dataPOST2 = controler2+"&"+trame;
	$.ajax({
		type: "POST",
		url: "../index.php",
		data: dataPOST
	});
	$.ajax({
		type: "POST",
		url: "../index.php",
		data: dataPOST2
	});
	document.getElementById('moteurid_0001').disabled = true;
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
		data: dataPOST
	});
}

function ModifierIntensite(clicked_id){
	var controler = "controle=dashboard&action=ModifierIntensite";
	var controler2 = "controle=gateway&action=sendCommand";
	var trame = '';
	var piece = "piece="+clicked_id[clicked_id.length -4]+clicked_id[clicked_id.length -3]+clicked_id[clicked_id.length -2]+clicked_id[clicked_id.length -1];
	var intensite = ""+document.getElementById(clicked_id).value;
	if(document.getElementById(clicked_id).value < 10)
	{
		intensite = '00'+document.getElementById(clicked_id).value;
	}
	else if(document.getElementById(clicked_id).value < 100)
	{
		intensite = '0'+document.getElementById(clicked_id).value;
	}
	trame = 'trame=1A02B1a030'+intensite+'65';
	var dataPOST = controler+"&"+piece+"&"+"intensite="+intensite;
	var dataPOST2 = controler2+"&"+trame;
	$.ajax({
		type: "POST",
		url: "../index.php",
		data: dataPOST
	});
		$.ajax({
		type: "POST",
		url: "../index.php",
		data: dataPOST2
	});
}
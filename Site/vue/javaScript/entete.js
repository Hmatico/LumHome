$(document).ready(function(){ 

	$("#suite").load(
		"dashboard2.php",
		{
			controle: "entete",
			action: "afficherPage",
			link: "dashboard2.php"
		}
	);
    $('button').click(function(){
		var lien = $(this).attr("class");
		document.getElementsByClassName("boutonclic")[0].classList.add("boutonpasclic");
		document.getElementsByClassName("txtclic")[0].classList.add("txtpasclic");
		document.getElementsByClassName("boutonclic")[0].classList.remove("boutonclic");
		document.getElementsByClassName("txtclic")[0].classList.remove("txtclic");
		
		if (lien == "btnaccueil") {
			var page="dashboard2.php";
			document.getElementsByClassName("boutonpasclic")[0].classList.add("boutonclic");
			document.getElementsByClassName("txtpasclic")[0].classList.add("txtclic");
			document.getElementsByClassName("boutonpasclic")[0].classList.remove("boutonpasclic");
			document.getElementsByClassName("txtpasclic")[0].classList.remove("txtpasclic");
		}
		if (lien == "btnscenario") {
			var page="gerer_sc.html";
			document.getElementsByClassName("boutonpasclic")[1].classList.add("boutonclic");
			document.getElementsByClassName("txtpasclic")[1].classList.add("txtclic");
			document.getElementsByClassName("boutonpasclic")[1].classList.remove("boutonpasclic");
			document.getElementsByClassName("txtpasclic")[1].classList.remove("txtpasclic");

		}
		if (lien == "btngerer") {
			var page="gerer.php";
			document.getElementsByClassName("boutonpasclic")[2].classList.add("boutonclic");
			document.getElementsByClassName("txtpasclic")[2].classList.add("txtclic");
			document.getElementsByClassName("boutonpasclic")[2].classList.remove("boutonpasclic");
			document.getElementsByClassName("txtpasclic")[2].classList.remove("txtpasclic");

		}
		if (lien == "btnstatistique") {
			var page="statistiques.php";
			document.getElementsByClassName("boutonpasclic")[3].classList.add("boutonclic");
			document.getElementsByClassName("txtpasclic")[3].classList.add("txtclic");
			document.getElementsByClassName("boutonpasclic")[3].classList.remove("boutonpasclic");
			document.getElementsByClassName("txtpasclic")[3].classList.remove("txtpasclic");

		}
		$("#suite").load(
			page,
			{
				controle: "entete",
				action: "afficherPage",
				link: page
			}
		);
     });
	$('img').click(function(){
		var lien = $(this).attr("class");

		if (lien == "logomoncompte") {
			var page="mod_infos.html";
			$("#suite").load(
				page,
				{
					controle: "entete",
					action: "afficherPage",
					link: page
				}
			);
		}
		else if (lien == "logodeconnexion") {
			var dataPOST = "controle=administration&action=deconnexion";
			$.ajax({
				type: "POST",
				url: "../index.php",
				data: dataPOST,
				success: function(data){
				},
			});
			var dataPOST = "controle=gestionSession&action=setInactif";
			$.ajax({
				type: "POST",
				url: "../index.php",
				data: dataPOST,
				success: function(data){
					document.location.href="accueil.html";
				},
			});
		}
	});
});
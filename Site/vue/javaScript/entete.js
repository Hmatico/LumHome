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

		if (lien == "btnaccueil") {
			var page="dashboard2.php";
		}
		if (lien == "btnscenario") {
			var page="gerer_sc.html";
		}
		if (lien == "btngerer") {
			var page="gerer.php";
		}
		if (lien == "btnstatistique") {
			var page="statistiques.php";
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
	$('a').click(function(){
		var lien = $(this).attr("class");

		if (lien == "txtmoncompte1") {
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
		else if (lien == "txtmoncompte2") {
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
$(document).ready(function(){ 
    $('button').click(function(){
		var lien = $(this).attr("class");
		if (lien == "btnaccueil") {
			var page="dashboard2.php";
		}
		if (lien == "btnscenario") {
			var page="vueScenario.php";
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
});
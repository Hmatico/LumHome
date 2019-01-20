$(document).ready(function(){
//    alert("JS_LOAD");
    $(document).load(
        "../index.php",
        {
            controle: "loadScenario",
            action:"load"
        }
    });
    /*,
        {

        alert("SUCCESS");
        alert(resultat);
        console.log(resultat);
//        var row = <?php echo json_encode($rowtest);?>;
//        alert(row);
////        alert($rowtest);
//        alert("DONE");

        addRow(data);*/
//            $(".row_gerer_scenario > td").click(function(event)
//            {
//                var element = $(event.target).text();
//            });

});//*/

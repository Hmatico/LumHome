<?php


function chargerScenario(){

  require("modele/connexionBD.php");
  $req= "SELECT nom, s.type, statut
        FROM scenario s
        INNER JOIN utilisateur
        WHERE utilisateur.adresseMail = s.fk_proprietaire";

  $res = mysqli_query($link,$req);
  $matrice = array();
  while ($row = $res->fetch_assoc()) {
     array_push($matrice,$row);
  }


    $answer = '<script>$(document).ready(function(){';

      foreach ($matrice as &$row) {

    $answer = $answer . 'addRow("'
    . $row["nom"] .
    '","' . $row["type"] .
    '","' . $row["statut"] . '");';
    }
    $answer = $answer . '});


function addRow(s1, s2, s3)
{

    var table = document.getElementsByTagName("tbody")[0];

    var row = document.createElement("tr");
    row.className = "row_gerer_scenario";

    var col1 = document.createElement("td");
    col1.className = "sc_name";

    var col2 = document.createElement("td");
    col2.className = "sc_type";

    var col3 = document.createElement("td");
        col3.className = "duration_picker";
    var txt1 = document.createTextNode(s1);
    var txt2 = document.createTextNode(s2);
    var txt3 = document.createTextNode(s3);

    var switch1 = document.createElement("label");
    var input = document.createElement("input");
    var slider = document.createElement("span");
    switch1.className = "switch";
    input.type = "checkbox";
    slider.className = "slider round";

    switch1.appendChild(input);
    switch1.appendChild(slider);

    col1.appendChild(txt1);
    col2.appendChild(txt2);
    col3.appendChild(switch1);

    row.appendChild(col1);
    row.appendChild(col2);
    row.appendChild(col3);

    table.appendChild(row);
}




</script>';

  mysqli_free_result($res);

  mysqli_close($link);

  return $answer;
}
?>

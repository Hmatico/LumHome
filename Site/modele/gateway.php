<?php

function sql_request($id, $type, $value)
{
    require("modele/connexionBD.php");
    $update =   "UPDATE cemac SET intensite = '%s' WHERE type = '%s' and numeroSerie='%s'";
    $req = sprintf($update, $value, $type,$id);
    $res = mysqli_query($link, $req)   
            or die (utf8_encode("erreur de requête : ") . $req .'\n'.mysqli_error($link));
}

?>
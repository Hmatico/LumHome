<?php

function sql_request($type, $value)
{
    require("modele/connexionBD.php");
    $update =   "UPDATE cemac SET intensite = '%s' WHERE type = '%s'";
    $req = sprintf($update, $value, $type);
    $res = mysqli_query($link, $req)   
            or die (utf8_encode("erreur de requête : ") . $req .'\n'.mysqli_error($link));
}

?>
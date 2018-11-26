<?php
    $hote='localhost';   		
    $login='serveur';  	        //root
    $pass='qmhd"rfhb1A$64!';    //		
    $bd='base_lumhome'; 

    if(!isset($link)){
    $link = mysqli_connect($hote, $login, $pass) 
            or die ("erreur de connexion :" . mysql_error()); 
    mysqli_select_db($link, $bd) 
            or die (utf8_encode("erreur d'accès à la base :") . $bd);
    }
?>
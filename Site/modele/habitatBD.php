<?php
    function getIdHabitatFacturation(&$num,&$rue,&$codep,&$ville,&$comp){
        require ("modele/connexionBD.php");
        $select= "select idHabitat from HABITAT where nomHabitat='%s' and numero='%s' and rue='%s' and ville='%s' and codePostal='%d' and complement='%s'"; 
        $req = sprintf($select,'facturation',$num,$rue,$ville,$codep,$comp);

        $res = mysqli_query($link, $req)	
            or die (utf8_encode("erreur de requête : ") . $req .'\n'.mysqli_error($link));
        $tab = mysqli_fetch_assoc($res);
        mysqli_close($link);
        return $tab[0];
    }

    function nouvelHabitatF(&$num,&$rue,&$codep,&$ville,&$comp){
        require ("modele/connexionBD.php");
        $insert = "insert into HABITAT (nomHabitat, numero, rue, ville, codePostal, complement) values('%s', '%s', '%s', '%s', '%d','%s')";
        
        $req = sprintf($insert,'facturation',$num,$rue,$ville,$codep,$comp);

        $res = mysqli_query($link, $req)	
            or die (utf8_encode("erreur de requête : ") . $req .'\n'.mysqli_error($link));
        mysqli_close($link);
    }
?>
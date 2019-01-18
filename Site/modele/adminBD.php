<?php

    function inputCGU(){
        require ("modele/connexionBD.php");
        $select= "select partie,texte from CGU"; 
        $req = sprintf($select);
        $answer = "<form id='form_modif_cgu'>";
        $res = mysqli_query($link, $req)	
            or die (utf8_encode("erreur de requête : ") . $req .'\n'.mysqli_error($link));
        $cpt = 1;
        while ($e = mysqli_fetch_assoc($res)) {
            $answer = $answer . '<input type="text" id="partie'.$cpt
                .'" value="'. utf8_encode($e['partie']) . '"><br>';
            $answer = $answer . '<textarea id="texte'.$cpt.'" rows="10" cols="80">'
                . utf8_encode($e['texte']) . "</textarea><br>";
            $cpt = $cpt + 1;
        }
        $answer = $answer . "<input type='button' value='Modifier'><br></form>";
        mysqli_close($link);
        return $answer;
    }

?>
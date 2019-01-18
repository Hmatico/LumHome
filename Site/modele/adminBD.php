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
        $answer = $answer . "<input id='ajoutCGU' type='button' value='Ajouter un paragraphe'><input id='supprCGU' type='button' value='Supprimer un paragraphe'><br><input type='button' value='Modifier les CGU'><br></form>";
        $answer = $answer . '<script>
        var cpt = '.$cpt. ';
        $("#ajoutCGU").click(function(){
            var partie = "partie" + cpt;
            var texte = "texte"+cpt;'
                . '$("#ajoutCGU").insertBefore("<input type="text" id=partie><br>");'
                . '$("#ajoutCGU").insertBefore("<textarea id=texte rows="10" cols="80"></teaxtarea><br>");
                cpt = cpt + 1;
        });
        </script>';
        mysqli_close($link);
        return $answer;
    }

?>
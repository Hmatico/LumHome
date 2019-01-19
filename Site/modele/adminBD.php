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
        $answer = $answer . "<input id='ajoutCGU' type='button' value='Ajouter un paragraphe'><input id='supprCGU' type='button' value='Supprimer un paragraphe'><br><input id='recCGU' type='button' value='Modifier les CGU'><br></form>";
        $answer = $answer . 
        '<script>
        var cpt = '.$cpt. ';
        $("#ajoutCGU").click(function(){
            var partie = "partie" + cpt;
            var texte = "texte"+cpt;'
                . '$("<input type=\'text\' id="+partie+"><br>").insertBefore("#ajoutCGU");'
                . '$("<textarea id="+texte+" rows=\'10\' cols=\'80\'></textarea><br>").insertBefore("#ajoutCGU");
                cpt = cpt + 1;
            $("#modifCGU").removeClass("disAble");
            $("#modifCGU").click();
        });
        $("#supprCGU").click(function(){
            if(cpt > 0){
                cpt = cpt -1;
                var partie = "partie" + cpt;
                var texte = "texte"+cpt;
                $("#" +partie).next().remove();
                $("#" +texte).next().remove();
                $("input").remove("#" +partie);
                $("textarea").remove("#" +texte);
            }
        });
        $("#recCGU").click(function(){
            var vide = false;
            $("input[type=\"text\"]").each(function(){
                $(this).css("border-color", "#ccc");
            });
            $("textarea").each(function(){
                $(this).css("border-color", "#000");
            });
            $("input[type=\"text\"]").each(function(){
                if($(this).val() ==""){
                    $(this).css("border-color", "red");
                    vide = true;
                }
            });
            $("textarea").each(function(){
                if($(this).val() ==""){
                    $(this).css("border-color", "red");
                    vide = true;
                }
            });
            if(vide == true){
                $(".modal .modal-content p").html("Au moins un des champs est vide !");
                $(".modal").css("display","block");
            } else {
                var controler = "controle=administration&action=modifCGU";
                var parties = "";
                var textes = "";
                $("input[type=\"text\"]").each(function(){
                    parties += "&" + $(this).attr("id") + "=" + $(this).val();
                });
                $("textarea").each(function(){
                    textes += "&" + $(this).attr("id") + "=" + $(this).val();
                });
                $.ajax({
                    type: "POST",
                    url: "../index.php",
                    data: controler+parties+textes,
                    success: function(data){
                        $(".modal .modal-content p").html("Modifications effectuées !");
                        $(".modal").css("display","block");
                    },
                    error: function(result){
                        console.log(result);
                    }
                });
            }
        });
        </script>';
        mysqli_close($link);
        return $answer;
    }

    function modifierCGU($parties,$textes){
        require ("modele/connexionBD.php");
        $delete= "delete from CGU"; 
        $req = sprintf($delete);
        $res = mysqli_query($link, $req)	
            or die (utf8_encode("erreur de requête : ") . $req .'\n'.mysqli_error($link));
        $insert = "";
        for($i=0 ; $i < sizeOf($parties) ; $i++){
            $insert = "INSERT INTO CGU(partie,texte) VALUES('%s','%s')";
            $req = sprintf($insert, $parties[$i], $textes[$i]);
            $res = mysqli_query($link, $req)	
                or die (utf8_encode("erreur de requête : ") . $req .'\n'.mysqli_error($link));
        }
        
        mysqli_close($link);
        return "ok";
    }

?>
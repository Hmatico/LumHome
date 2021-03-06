<?php

    /**
    * Fonction récupérant les questions depuis la base de données
    */
    function inputFAQ(){
        require ("modele/connexionBD.php");
        $select= "select question,reponse from QUESTIONS"; 
        $req = sprintf($select);
        $answer = "<form id='form_modif_faq'>";
        $res = mysqli_query($link, $req)	
            or die (utf8_encode("erreur de requête : ") . $req .'\n'.mysqli_error($link));
        $cpt = 1;
        while ($e = mysqli_fetch_assoc($res)) {
            $answer = $answer . '<input type="text" id="question'.$cpt
                .'" value="'. utf8_encode($e['question']) . '"><br>';
            $answer = $answer . '<textarea id="reponse'.$cpt.'" rows="10" cols="80">'
                . utf8_encode($e['reponse']) . "</textarea><br>";
            $cpt = $cpt + 1;
        }
        /* Ajout des boutons en dessous des questions */
        $answer = $answer . "<input id='ajoutFAQ' type='button' value='Ajouter une question'><input id='supprFAQ' type='button' value='Supprimer une question'><br><input id='recFAQ' type='button' value='Modifier les questions'><br></form>";
        /* Ajout des scripts de :
            - ajout d'une question
            - suppression de la dernière question
            - validation des modifications de la FAQ
        */
        $answer = $answer . 
        '<script>
        var cpt1 = '.$cpt. ';
        $("#ajoutFAQ").click(function(){
            var question = "question" + cpt1;
            var reponse = "reponse"+cpt1;'
                . '$("<input type=\'text\' id="+question+" placeholder=\'Question...\'><br>").insertBefore("#ajoutFAQ");'
                . '$("<textarea id="+reponse+" rows=\'10\' cols=\'80\' placeholder=\'Réponse...\'></textarea><br>").insertBefore("#ajoutFAQ");
                cpt1 = cpt1 + 1;
            $("#modifFAQ").removeClass("disAble");
            $("#modifFAQ").click();
        });
        $("#supprFAQ").click(function(){
            if(cpt1 > 0){
                cpt1 = cpt1 -1;
                var question = "question" + cpt1;
                var reponse = "reponse"+cpt1;
                $("#" +question).next().remove();
                $("#" +reponse).next().remove();
                $("input").remove("#" +question);
                $("textarea").remove("#" +reponse);
            }
        });
        $("#recFAQ").click(function(){
            var vide = false;
            $("#form_modif_faq input[type=\"text\"]").each(function(){
                $(this).css("border-color", "#ccc");
            });
            $("#form_modif_faq textarea").each(function(){
                $(this).css("border-color", "#000");
            });
            $("#form_modif_faq input[type=\"text\"]").each(function(){
                if($(this).val() ==""){
                    $(this).css("border-color", "red");
                    vide = true;
                }
            });
            $("#form_modif_faq textarea").each(function(){
                if($(this).val() ==""){
                    $(this).css("border-color", "red");
                    vide = true;
                }
            });
            if(vide == true){
                $(".modal .modal-content p").html("Au moins un des champs est vide !");
                $(".modal").css("display","block");
            } else {
                var controler = "controle=administration&action=modifFAQ";
                var questions = "";
                var reponses = "";
                $("#form_modif_faq input[type=\"text\"]").each(function(){
                    questions += "&" + $(this).attr("id") + "=" + $(this).val();
                });
                $("#form_modif_faq textarea").each(function(){
                    reponses += "&" + $(this).attr("id") + "=" + $(this).val();
                });
                $.ajax({
                    type: "POST",
                    url: "../index.php",
                    data: controler+questions+reponses,
                    success: function(data){
                        if(data == "ok"){
                            $(".modal .modal-content p").html("Modifications effectuées !");
                            $(".modal").css("display","block");
                        } else alert(data);
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

    /**
    * Fonction récupérant les cgu depuis la base de données
    */
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
        /* Ajout des scripts de :
            - ajout d'une partie
            - suppression de la dernière partie
            - validation des modifications des CGU
        */
        $answer = $answer . 
        '<script>
        var cpt = '.$cpt. ';
        $("#ajoutCGU").click(function(){
            var partie = "partie" + cpt;
            var texte = "texte"+cpt;'
                . '$("<input type=\'text\' id="+partie+" placeholder=\'Article...\'><br>").insertBefore("#ajoutCGU");'
                . '$("<textarea id="+texte+" rows=\'10\' cols=\'80\' placeholder=\'Texte...\'></textarea><br>").insertBefore("#ajoutCGU");
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
            $("#form_modif_cgu input[type=\"text\"]").each(function(){
                $(this).css("border-color", "#ccc");
            });
            $("#form_modif_cgu textarea").each(function(){
                $(this).css("border-color", "#000");
            });
            $("#form_modif_cgu input[type=\"text\"]").each(function(){
                if($(this).val() ==""){
                    $(this).css("border-color", "red");
                    vide = true;
                }
            });
            $("#form_modif_cgu textarea").each(function(){
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
                $("#form_modif_cgu input[type=\"text\"]").each(function(){
                    parties += "&" + $(this).attr("id") + "=" + $(this).val();
                });
                $("#form_modif_cgu textarea").each(function(){
                    textes += "&" + $(this).attr("id") + "=" + $(this).val();
                });
                $.ajax({
                    type: "POST",
                    url: "../index.php",
                    data: controler+parties+textes,
                    success: function(data){
                        if(data == "ok"){
                            $(".modal .modal-content p").html("Modifications effectuées !");
                            $(".modal").css("display","block");
                        } else alert(data);
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

    /**
    * Fonction modifiant les questions en base
    *   $questions : liste des questions
    *   $reponses : liste des réponses
    */
    function modifierFAQ($questions,$reponses){
        require ("modele/connexionBD.php");
        $delete= "delete from QUESTIONS"; 
        $req = sprintf($delete);
        $res = mysqli_query($link, $req)	
            or die (utf8_encode("erreur de requête : ") . $req .'\n'.mysqli_error($link));
        
        for($i=0 ; $i < sizeOf($questions) ; $i++){
            $insert = 'INSERT INTO QUESTIONS(question,reponse) VALUES ("' . htmlentities($questions[$i]) . '","' . htmlentities($reponses[$i]) . '");';
            $req = sprintf($insert);
            $res = mysqli_query($link, $req)	
                or die (utf8_encode("erreur de requête : ") . $req .'\n'.mysqli_error($link));
        }
        
        mysqli_close($link);
        return "ok";
    }

    /**
    * Fonction modifiant les cgu en base
    *   $parties : liste des articles
    *   $textes : liste des paragraphes
    */
    function modifierCGU($parties,$textes){
        require ("modele/connexionBD.php");
        $delete= "delete from CGU"; 
        $req = sprintf($delete);
        $res = mysqli_query($link, $req)	
            or die (utf8_encode("erreur de requête : ") . $req .'\n'.mysqli_error($link));
        
        for($i=0 ; $i < sizeOf($parties) ; $i++){
            $insert = 'INSERT INTO CGU(partie,texte) VALUES ("' . htmlentities($parties[$i]) . '","' . htmlentities($textes[$i]) . '");';
            $req = sprintf($insert);
            $res = mysqli_query($link, $req)	
                or die (utf8_encode("erreur de requête : ") . $req .'\n'.mysqli_error($link));
            
        }
        
        mysqli_close($link);
        return "ok";
    }

    /**
    * Fonction déconnectant l'administrateur en base
    */
    function decoAdmin($mail,$boolean){
        require("modele/connexionBD.php");
        $update = "update Utilisateur set actif = '%d\n' where adresseMail = '%s'";
        $req = sprintf($update,$boolean,$mail);
        $res = mysqli_query($link, $req)	
            or die (utf8_encode("erreur de requête : ") . $req .'\n'.mysqli_error($link));
        mysqli_close($link);
    }

?>
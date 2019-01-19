<?php

    function getAllQuestions(){
        require ("modele/connexionBD.php");
        $select= "select question,reponse from QUESTIONS"; 
        $req = sprintf($select);
        $answer = "";
        $res = mysqli_query($link, $req)	
            or die (utf8_encode("erreur de requête : ") . $req .'\n'.mysqli_error($link));
        while ($e = mysqli_fetch_assoc($res)) {
            $answer = $answer . '<button class="accordion">'
                . utf8_encode($e['question']) . "</button>";
            $answer = $answer . '<div class="accordionContent"><p>'
                . utf8_encode($e['reponse']) . "</p></div>";
        }
            $answer = $answer .'<script>
            $(".accordion").click(function(){
                $(".accordion").each(function(){
                    if($(this).hasClass("disAble"))
                        $(this).toggleClass("disAble");
                    this.nextElementSibling.style.maxHeight = null;
                });
                $(this).toggleClass("disAble");
                this.nextElementSibling.style.maxHeight = this.nextElementSibling.scrollHeight + "px";
            });
            </script>';
        mysqli_close($link);
        return $answer;
    }

    function cgu(){
        require ("modele/connexionBD.php");
        $select= "select partie,texte from CGU"; 
        $req = sprintf($select);
        $answer = "";
        $res = mysqli_query($link, $req)	
            or die (utf8_encode("erreur de requête : ") . $req .'\n'.mysqli_error($link));
        while ($e = mysqli_fetch_assoc($res)) {
            $answer = $answer . '<b><em>'
                . utf8_encode($e['partie']) . "</em></b><br>";
            $answer = $answer . utf8_encode($e['texte']) ."<br>";
        }
        mysqli_close($link);
        return $answer;
    }

?>
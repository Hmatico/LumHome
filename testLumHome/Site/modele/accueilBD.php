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
            return $answer;
    }

?>
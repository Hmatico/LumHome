<?php

    /**
    * Fonction récupérant les questions depuis la base de données
    */
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
        /* Script de pour faire fonctionner les onglets */
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

    /**
    * Fonction récupérant les cgu depuis la base de données
    */
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

    /**
    * Fonction récupérant l'email d'un admin
    */
    function mailAdmin(&$nom, &$mail, &$obj, &$msg){
        require ("modele/connexionBD.php");
        $select= "select * from UTILISATEUR where type='admin'"; 
        $req = sprintf($select);
        $answer = "";
        $res = mysqli_query($link, $req)	
            or die (utf8_encode("erreur de requête : ") . $req .'\n'.mysqli_error($link));
        while ($e = mysqli_fetch_assoc($res)) {
            $answer = $e['adresseMail'];
        }
        $headers ='From: "nom"serveur.lumhome@gmail.com' . "\n";
         $headers .='Reply-To: '.$answer."\n";
         $headers .='Content-Type: text/html; charset="iso-8859-1"'."\n";
         $headers .='Content-Transfer-Encoding: 8bit';

         $message ='<html><head><title>'. $obj . '</title></head><body>'. $msg .'</body></html>';

         if(mail($answer, 'Demande : '.$obj, $message, $headers))
         {
              return 'Le message a été envoyé';
         }
         else
         {
              return 'Le message n\'a pu être envoyé';
         }   
    }

?>
<?php

function getLogs(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"http://projets-tomcat.isep.fr:8080/appService/?ACTION=GETLOG&TEAM=A02B");
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $data = curl_exec($ch);
    curl_close($ch);
    
    $moteur = "";
    $lum = "";

    $data_tab = str_split($data,33);
    for($i=count($data_tab) - 1;$i>=count($data_tab) - 100;$i--){
        list($t,$o,$r,$c,$n,$v,$a,$x,$year,$month,$day,$hour,$min,$sec) = sscanf($data_tab[$i],"%1s%4s%1s%1s%2s%4s%4s%2s%4s%2s%2s%2s%2s%2s");
        if($t != null){
            if($moteur == ""){
                if($n=="02"){
                    $moteur = $v;
                }
            }
            if($lum == ""){
                if($n=="01"){
                    $lum = $v;
                }
            }
        }
    }
    require("modele/gateway.php");
    sql_request($o."02","moteur",hexdec($moteur));
    sql_request($o."01","ampoule",hexdec($lum));
	echo $o.'02,"moteur"'. hexdec($moteur) .' + '.$o.'01,"ampoule"'.hexdec($lum);
}


function sendCommand(){
    $trame = $_POST["trame"];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://projets-tomcat.isep.fr:8080/appService/?ACTION=COMMAND&TEAM=A02B&TRAME=".$trame);
    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $ans = curl_exec($ch); 
 
    curl_close($ch);
    
    echo "<br /> Réponse : ";
    echo htmlspecialchars($ans);
}

?>
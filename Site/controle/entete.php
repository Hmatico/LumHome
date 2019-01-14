<?php
    function afficherPage(){
        $lien = $_POST['link'];
        $buffer = "vue/".$lien.".php";
        require(buffer);
    }
?>
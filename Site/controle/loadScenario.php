<?php
    function load()
    {
      require("modele/scenarioBDtest.php");

      require("vue/vueScenario.php");
      echo chargerScenario();

    }
?>

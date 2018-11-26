<?php

function accueil(){
    header("Location: vue/accueil.html");
}

function ident(){
    $login = $_POST['login'];
    $pwd = $_POST['pwd'];
    echo "$login et $pwd";
}
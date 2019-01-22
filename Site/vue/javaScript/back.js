$(document).ready(function(){
    
    /* Au clic sur le bouton de connexion */
    $(".accueil_con .btnc").click(function(){
        /* initialisation des champs */
        $("#login").css('border-color', '#ccc');
        $("#pwd").css('border-color', '#ccc');
        if($("#login").val() != "" && $("#pwd").val() != ""){
            /* Préparation des variables */
            var mail = $("#login").val();
            var pass = $("#pwd").val();
            var controler = "controle=gestionSession&action=ident";
            var email_content = "login="+ mail;
            var pwd_content = "pwd="+ pass;
            /* ENvoi au controler via ajax */
            $.ajax({
                type: "POST",
                url: "../index.php",
                data: controler+"&"+email_content+"&"+pwd_content,
                success: function(data){
                    if(data == "inconnu"){
                        /* Affichage du modal d'erreur */
                        $(".modal .modal-content p").html("Utilisateur inconnu !"+'\n'+"Si vous n'avez pas de compte, créez le !");
                        $(".modal").css("display","block");
                    } else {
                        /* Affichage du modal d'erreur */
                        if(data == "incorrect"){
                            $(".modal .modal-content p").html("Identifiant ou mot de passe incorrect !");
                            $(".modal").css("display","block");
                        /* Appel à connexion */    
                        } else {
                            console.log(data);
                            connexion(data);
                        }
                    }
                },
                error: function(result){
                    if(result){
                        console.log(result);
                    }
                }
            });
        } else {
            /* Affichage du modal d'erreur */
            $(".modal .modal-content p").html("Au moins un des champs est vide !");
            $(".modal").css("display","block");
            if($("#login").val() == "")
                $("#login").css('border-color', 'red');
            if($("#pwd").val() == "")
                $("#pwd").css('border-color', 'red');
        }
    });
    
    /* Au clic sur le bouton d'inscription */
    $(".accueil_ins .btn").click(function(){
        /* initialisation des champs */
        $("#select_profil").css('border-color', '#ccc');
        $("#logini").css('border-color', '#ccc');
        $("#pwdi").css('border-color', '#ccc');
        $("#loginci").css('border-color', '#ccc');
        $("#pwdci").css('border-color', '#ccc');
        $("#cap").css('border-color', '#ccc');
        /* Vérification des champs vides */
        if($("#logini").val() != "" && $("#pwdi").val() != "" && $("#loginci").val() != "" && $("#pwdci").val() != "" && $("#select_profil option:selected").val() !="" && $("#cap").val()!=""){
            if($("#cgu").is(':checked')){
                if($("#logini").val() === $("#loginci").val())
                    if($("#pwdi").val() === $("#pwdci").val())
                        /* Si tous les champs sont remplis, appel de la fonction inscripttion */
                        inscription();
                    else {
                        /* Affichage du modal d'erreur */
                        $(".modal .modal-content p").html("Les mots des passes sont différents");
                        $(".modal").css("display","block");
                        $("#pwdi").css('border-color', 'red');
                        $("#pwdci").css('border-color', 'red');
                    }
                else {
                    /* Affichage du modal d'erreur */
                    $(".modal .modal-content p").html("Les emails sont différents");
                    $(".modal").css("display","block");
                    $("#logini").css('border-color', 'red');
                    $("#loginci").css('border-color', 'red');
                }
            } else {
                /* Affichage du modal d'erreur */
                $(".modal .modal-content p").html("Veuillez accepter les CGU");
                $(".modal").css("display","block");
            }
        } else {
            /* Affichage du modal d'erreur */
            $(".modal .modal-content p").html("Au moins un des champs est vide !");
            $(".modal").css("display","block");
            if($("#select_profil option:selected").val() == "")
                $("#select_profil").css('border-color', 'red');
            if($("#logini").val() == "")
                $("#logini").css('border-color', 'red');
            if($("#pwdi").val() == "")
                $("#pwdi").css('border-color', 'red');
            if($("#loginci").val() == "")
                $("#loginci").css('border-color', 'red');
            if($("#pwdci").val() == "")
                $("#pwdci").css('border-color', 'red');
            if($("#cap").val() == "")
                $("#cap").css('border-color', 'red');
        }
    })
});
    /* Fonction d'envoi des données pour l'inscription en base*/
    function inscription(){
        /* Préparation des données */
        var controler = "controle=gestionSession&action=creationCompte";
        var email = "email="+$("#logini").val();
        var pwd = "pwd="+$("#pwdi").val();
        var cap = "cap="+$("#cap").val();
        var profil = "profil="+$("#select_profil option:selected").val();
        var dataPOST = controler+"&"+email+"&"+pwd+"&"+cap+"&"+profil;
        /* Requête ajax */
        $.ajax({
            type: "POST",
            url: "../index.php",
            data: dataPOST,
            success: function(data){
                /* Fonction de retour du serveur */
                retourInscription(data);
            },
            error: function(result){
                if(result){
                    console.log(result);
                }
            }
        });
    }
    
/* Fonction traitant la réponse du serveur */
    function retourInscription(result){
        /* Cas mot de passe pas au bon format */
        if(result == "pwdFAUX"){
            $(".modal .modal-content p").html("Le mot de passe n'est pas au bon format !");
            $(".modal").css("display","block");
            $("#pwdi").css('border-color', 'red');
            $("#pwdci").css('border-color', 'red');
        }
        /* Cas email pas au bon format */
        if(result == "emailFAUX"){
            $(".modal .modal-content p").html("L'adresse email n'est pas correcte !");
            $(".modal").css("display","block");
            $("#logini").css('border-color', 'red');
            $("#loginci").css('border-color', 'red');
        }
        /* Cas utilisateur déjà existant */
        if(result == "existant") {
            $(".modal .modal-content p").html("L'email est déjà utilisé !");
            $(".modal").css("display","block");
            $("#logini").css('border-color', 'red');
            $("#loginci").css('border-color', 'red');
        }
        /* Cas tout st bon */
        if(result=="user" || result=="maire" || result=="promoteur" || result=="maintenance"){
            $(".modal .modal-content p").html("Vous êtes inscrit !");
            $(".modal").css("display","block");
            /* Renvoie vers la fonction connexion */
            setTimeout(function(){ connexion(result)}, 3000);
        }
        /* Cas cemac déjà existant */
        if(result=="cexistant"){
            $(".modal .modal-content p").html("Le numéro de série est déjà utilisé !");
            $(".modal").css("display","block");
            $("#cap").css('border-color', 'red');
        }
    }

    /* Charge les questions de la page faq */
    $("#accordionSet").ready(function(){
        $("#accordionSet").load(
            "../index.php",
            {
                controle: "accueil",
                action: "questions"
            }
        );

    });

    /* Fonction changeant la localisation de la pag en fonction du profil */
    function connexion(profil){
        /* Met l'utilisateur en tant qu'actif */
        var controler = "controle=gestionSession&action=setActif";
        $.ajax({
            type: "POST",
            url: "../index.php",
            data: controler,
            success: function(data){
                if(profil=="user")
                    $(location).attr('href',"entete.html");
                if(profil=="admin")
                    $(location).attr('href',"administration.html");
                if(profil=="maire")
                    $(location).attr('href',"mairie.html");
                if(profil=="promoteur")
                    $(location).attr('href',"promoteur.html");
                if(profil=="maintenance")
                    $(location).attr('href',"maintenance.html");
            },
            error: function(result){
                if(result){
                    console.log(result);
                }
            }
        });
    }

    /* Charge le nombre d'utilisateurs actifs */
    $("#userCo").ready(function(){
        $("#userCo").load(
            "../index.php",
            {
                controle: "administration",
                action: "actif"
            }
        );
    });

    /* Charge le nombre d'utilisateurs inactifs */
    $("#userDeco").ready(function(){
        $("#userDeco").load(
            "../index.php",
            {
                controle: "administration",
                action: "inactif"
            }
        );
    });

    $(".cgu_info").click(function(){
        $(".modal .modal-content p").load(
            "../index.php",
            {
                controle: "accueil",
                action: "getCGU"
            }
        );
        $(".modal").css("display","block");
    });

    /* Charge les questions de la faq au clic sur l'onglet (admin) */
    $("#modifFAQ").ready(function(){
        $("#modifFAQ + .accordionContent").load(
            "../index.php",
            {
                controle: "administration",
                action: "afficherFAQ"
            }
        );
    });

    /* Charge les parties des cgu au clic sur l'onglet (admin) */
    $("#modifCGU").ready(function(){
        $("#modifCGU + .accordionContent").load(
            "../index.php",
            {
                controle: "administration",
                action: "afficherCGU"
            }
        );
    });

    /* Deconnexion de l'admin */
    $("#admin_out").click(function(){
        $.ajax({
           type: "POST",
           url: "../index.php",
           data: "controle=administration&action=deconnexion",
           success: function(data){
                $(".modal .modal-content p").html("Vous allez être redirigé vers la page d'accueil dans 3 secondes.");
                $(".modal").css("display","block");
                setTimeout(function(){ $(location).attr('href', 'accueil.html')}, 3000);
            },
            error: function(result){
                console.log(result);
            }
        });
    });
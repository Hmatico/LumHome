$(document).ready(function(){
    
    $(".accueil_con .btnc").click(function(){
        $("#login").css('border-color', '#ccc');
        $("#pwd").css('border-color', '#ccc');
        if($("#login").val() != "" && $("#pwd").val() != ""){
            var mail = $("#login").val();
            var pass = $("#pwd").val();
            var controler = "controle=gestionSession&action=ident";
            var email_content = "login="+ mail;
            var pwd_content = "pwd="+ pass;
            $.ajax({
                type: "POST",
                url: "../index.php",
                data: controler+"&"+email_content+"&"+pwd_content,
                success: function(data){
                    if(data == "inconnu"){
                        $(".modal .modal-content p").html("Utilisateur inconnu !"+'\n'+"Si vous n'avez pas de compte, créez le !");
                        $(".modal").css("display","block");
                    } else {
                        if(data == "incorrect"){
                            $(".modal .modal-content p").html("Identifiant ou mot de passe incorrect !");
                            $(".modal").css("display","block");
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
            $(".modal .modal-content p").html("Au moins un des champs est vide !");
            $(".modal").css("display","block");
            if($("#login").val() == "")
                $("#login").css('border-color', 'red');
            if($("#pwd").val() == "")
                $("#pwd").css('border-color', 'red');
        }
    })
    
    $(".accueil_ins .btn").click(function(){
        $("#select_profil").css('border-color', '#ccc');
        $("#logini").css('border-color', '#ccc');
        $("#pwdi").css('border-color', '#ccc');
        $("#loginci").css('border-color', '#ccc');
        $("#pwdci").css('border-color', '#ccc');
        $("#cap").css('border-color', '#ccc');
        if($("#logini").val() != "" && $("#pwdi").val() != "" && $("#loginci").val() != "" && $("#pwdci").val() != "" && $("#select_profil option:selected").val() !="" && $("#cap").val()!=""){
            if($("#cgu").is(':checked')){
                if($("#logini").val() === $("#loginci").val())
                    if($("#pwdi").val() === $("#pwdci").val())
                        inscription();
                    else {
                        $(".modal .modal-content p").html("Les emails sont différents");
                        $(".modal").css("display","block");
                        $("#pwdi").css('border-color', 'red');
                        $("#pwdci").css('border-color', 'red');
                    }
                else {
                    $(".modal .modal-content p").html("Les emails sont différents");
                    $(".modal").css("display","block");
                    $("#logini").css('border-color', 'red');
                    $("#loginci").css('border-color', 'red');
                }
            } else {
                $(".modal .modal-content p").html("Veuillez accepter les CGU");
                $(".modal").css("display","block");
            }
        } else {
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
    
    function inscription(){
        var controler = "controle=gestionSession&action=creationCompte";
        var email = "email="+$("#logini").val();
        var pwd = "pwd="+$("#pwdi").val();
        var cap = "cap="+$("#cap").val();
        var profil = "profil="+$("#select_profil option:selected").val();
        var dataPOST = controler+"&"+email+"&"+pwd+"&"+cap+"&"+profil;
        $.ajax({
            type: "POST",
            url: "../index.php",
            data: dataPOST,
            success: function(data){
                retourInscription(data);
            },
            error: function(result){
                if(result){
                    console.log(result);
                }
            }
        });
    }
    
    function retourInscription(result){
        if(result == "pwdFAUX"){
            $(".modal .modal-content p").html("Le mot de passe n'est pas au bon format !");
            $(".modal").css("display","block");
            $("#pwdi").css('border-color', 'red');
            $("#pwdci").css('border-color', 'red');
        }
        if(result == "emailFAUX"){
            $(".modal .modal-content p").html("L'adresse email n'est pas correcte !");
            $(".modal").css("display","block");
            $("#logini").css('border-color', 'red');
            $("#loginci").css('border-color', 'red');
        }
        if(result == "existant") {
            $(".modal .modal-content p").html("L'email est déjà utilisé !");
            $(".modal").css("display","block");
            $("#logini").css('border-color', 'red');
            $("#loginci").css('border-color', 'red');
        }
        if(result=="user" || result=="maire" || result=="promoteur" || result=="maintenance")
            $(".modal .modal-content p").html("Vous êtes inscrit !");
        $(".modal").css("display","block");
            connexion(result);
        if(result=="cexistant"){
            $(".modal .modal-content p").html("Le numéro de série est déjà utilisé !");
            $(".modal").css("display","block");
            $("#cap").css('border-color', 'red');
        }
    }

    $("#accordionSet").ready(function(){
        $("#accordionSet").load(
            "../index.php",
            {
                controle: "accueil",
                action: "questions"
            }
        );

    });

    function connexion(profil){
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

    $("#userCo").ready(function(){
        $("#userCo").load(
            "../index.php",
            {
                controle: "administration",
                action: "actif"
            }
        );
    });

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

    $("#modifFAQ").ready(function(){
        $("#modifFAQ ~ .accordionContent").load(
            "../index.php",
            {
                controle: "administration",
                action: "afficherFAQ"
            }
        );
    });

    $("#modifCGU").ready(function(){
        $("#modifCGU ~ .accordionContent").load(
            "../index.php",
            {
                controle: "administration",
                action: "afficherCGU"
            }
        );
    });
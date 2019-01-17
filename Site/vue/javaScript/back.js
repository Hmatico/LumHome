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
                        alert("Utilisateur inconnu !"+'\n'+"Si vous n'avez pas de compte, créez le !");
                    } else {
                        if(data == "incorrect"){
                            alert("Identifiant ou mot de passe incorrect !")
                        } else {
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
            alert("Au moins un des champs est vide !");
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
                        alert("Les emails sont différents");
                        $("#pwdi").css('border-color', 'red');
                        $("#pwdci").css('border-color', 'red');
                    }
                else {
                    alert("Les emails sont différents");
                    $("#logini").css('border-color', 'red');
                    $("#loginci").css('border-color', 'red');
                }
            } else {
                alert("Veuillez accepter les CGU");
            }
        } else {
            alert("Au moins un des champs est vide !");
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
            alert("Le mot de passe n'est pas au bon format !");
            $("#pwdi").css('border-color', 'red');
            $("#pwdci").css('border-color', 'red');
        }
        if(result == "emailFAUX"){
            alert("L'adresse email n'est pas correcte !");
            $("#logini").css('border-color', 'red');
            $("#loginci").css('border-color', 'red');
        }
        if(result == "existant") {
            alert("L'email est déjà utilisé !");
            $("#logini").css('border-color', 'red');
            $("#loginci").css('border-color', 'red');
        }
        if(result=="user" || result=="maire" || result=="promoteur" || result=="maintenance")
            alert("Vous êtes inscrit !");
            connexion(result);
        if(result=="cexistant"){
            alert("Le numéro de série est déjà utilisé !");
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
            
    }
/*
            var params = new Array();
            var mail = $("#email").val();
            var pass = $("#pwd").val();
            var email_content = "login="+ mail;
            var pwd_content = "pwd="+pass;
            params.push(email_content);
            params.push(pwd_content);
            var controls = new Array();
            controls.push("gestionSession");
            controls.push("ident");
            ajaxFactorized(params,controls,choixInscription(data, mail,pass));
    
    
    function ajaxFactorized(parameters, controlers, callback){
        var controle = "control="+controlers.eq(0).val();
        var action = "action="+controlers.eq(1).val();
        var controler = controle+"&"+action;
        var dataPOST = controler;
        parameters.each(function(){
            dataPOST += "&" + $(this).val(); 
        });
        $.ajaxFactorized({
            type: "POST",
            url: "../index.php",
            data: dataPOST,
            success: function(data){
                //console.log(data);
                callback(); 
            },
            error: function(result){
                if(result){
                    console.log(result);
                }
            }
        });
    }
*/
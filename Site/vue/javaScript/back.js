$(document).ready(function(){
    
    
    
    $(".accueil_form .btn").click(function(){
        //console.log("email : "+ $("#email").val());
        //console.log("pwd: "+ $("#pwd").val());
        
        if($("#email").val() != "" && $("#pwd").val() != ""){
            var mail = $("#email").val();
            var pass = $("#pwd").val();
            var controler = "controle=gestionSession&action=ident";
            var email_content = "login="+ mail;
            var pwd_content = "pwd="+pass;
            $.ajax({
                type: "POST",
                url: "../index.php",
                data: controler+"&"+email_content+"&"+pwd_content,
                success: function(data){
                    //console.log(data);
                    choixInscription(data, mail,pass); 
                },
                error: function(result){
                    if(result){
                        console.log(result);
                    }
                }
            });
            
        } else {
            alert("Au moins un des champs est vide !");
        }
    });
    
    function choixInscription(valeur, mail, pass){
        if(valeur == "inconnu"){
           if(confirm("Utilisateur inconnu !"+'\n'+"Voulez-vous créer un compte ?")){
                $("#body").load(
                    "../index.php",
                    {
                        controle: "gestionSession",
                        action: "nouvelUtilisateur",
                        login: mail,
                        pwd: pass
                    }
                );
            } else {
                $(location).attr("href", "./accueil.html");
            }
        } else {
            if(valeur == "OK"){
                //TO DO
            }
        }
    }
    
     $(".body_container .button").click(function(){
         if(champsRemplis())
             if(verifChamps())
                 inscription();
     });
                                          
     function champsRemplis() {
         $(".body_container input").css('border-color', '#ccc');
         var empty = false;
         $(".body_container input").each(function(){
             if($(this).val()===""){
                empty = true;
                $(this).css('border-color', 'red'); 
             } 
         });
         if(empty){
             alert("Veuillez renseigner les champs obligatoires");
             return false;
         }
         else return true;
     }
    
    function verifChamps(){
        erreur = false;
        erreur2 = false;
        if($("#nom").val().length > 15){
            $("#nom").css('border-color', 'red');
            erreur = true;
        }
        if($("#prenom").val().length > 15){
            $("#prenom").css('border-color', 'red');
            erreur = true;
        }
        if($("#email").val().length > 30){
            $("#email").css('border-color', 'red');
            erreur = true;
        }
        if($("#pwd").val().length > 30){
            $("#pwd").css('border-color', 'red');
            erreur = true;
        }
        if($("#nrue").val().length > 10){
            $("#nrue").css('border-color', 'red');
            erreur = true;
        }
        if($("#nomrue").val().length > 30){
            $("#nomrue").css('border-color', 'red');
            erreur = true;
        }
        if($("#cpostal").val().length > 5){
            $("#cpostal").css('border-color', 'red')
            erreur = true;
        }
        if($("#ville").val().length > 30){
            $("#ville").css('border-color', 'red');
            erreur = true;
        }
        if($("#ncarte").val().length != 19){
            $("#ncarte").css('border-color', 'red');
            erreur2 = true;
        }
        if($("#expiration").val().length != 5){
            $("#expiration").css('border-color', 'red');
            erreur2 = true;
        }
        if($("#crypto").val().length != 3){
            $("#crypto").css('border-color', 'red');
            erreur2 = true;
        }
        if(erreur)
            alert("Les données en rouge sont trop grandes !");
        if(erreur2)
            alert("Les données en rouge ne sont pas au bon format !");
        return !erreur;
    }
    
    function inscription(){
        var controler = "controle=gestionSession&action=creationCompte";
        var nom = "nom="+$("#nom").val();
        var prenom = "prenom="+$("#prenom").val();
        var email = "email="+$("#email").val();
        var emailc = "emailc="+$("#emailc").val();
        var pwd = "pwd="+$("#pwd").val();
        var pwdc = "pwdc="+$("#pwdc").val();
        var nomrue = "nomrue="+$("#nomrue").val();
        var cpostal = "cpostal="+$("#cpostal").val();
        var ville = "ville="+$("#ville").val();
        var comp = "comp="+$("#complement").val();
        var ncarte = "ncarte="+$("#ncarte").val();
        var date = "date="+$("#expiration").val();
        var crypto = "crypto="+$("#crypto").val();
        var dataPOST = controler+"&"+nom+"&"+prenom+"&"+email+"&"+emailc+"&"+pwd+"&"+pwdc+"&"+nrue+"&"+nomrue+"&"+cpostal+"&"+ville+"&"+comp+"&"+ncarte+"&"+date+"&"+crypto;
        $.ajax({
            type: "POST",
            url: "../index.php",
            data: dataPOST,
            success: function(data){
                console.log(data);
            },
            error: function(result){
                if(result){
                    console.log(result);
                }
            }
        });
    }

});

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
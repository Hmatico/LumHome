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
           if(confirm("Voulez-vous créer un compte ?")){
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
                $(location).attr("href", "./vue/accueil.html");
            }
        } else {
            if(valeur == "OK"){
                //TO DO
            }
        }
    }
    
     $(".body_container .button").click(function(){
         champsRemplis();
     });
                                          
     function champsRemplis() {
         var empty = false;
         $(".body_container input").each(function(){
             if($(this).val()===""){
                 empty = true;
                console.log($(this).css('border-color', 'red')); 
             } 
         });
         if(empty)
             alert("Veuillez renseigner les champs obligatoires");
         else {
             //
         }
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
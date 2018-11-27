$(document).ready(function(){
    
    $(".accueil_form .btn").click(function(){
        console.log("email : "+ $("#email").val());
        console.log("pwd: "+ $("#pwd").val());
        
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
                    console.log(data);
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
});

/*
if(data == "OK"){
                        controler = "controle=utilisateur&action=dashboard";
                        $(location).attr("href", "./index.php"+"?"+controler+"&"+email_content+"&"+pwd_content);
                    }
                    if(data == "inconnu"){
                        if(confirm("Voulez-vous créer un compte ?")){ 
                            $.load(
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
                    }
$.ajax({
                type: "POST",
                url: "../index.php",
                data: controler+"&"+email_content+"&"+pwd_content,
                success: function(data){
                    $(this).result = data;
                },
                error: function(result){
                    if(result){
                        console.log(result);
                    }
                }
            });
*/
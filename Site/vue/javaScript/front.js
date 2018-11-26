$(document).ready(function(){
    
    $(".accueil_form .btn").click(function(){
        console.log("email : "+ $("#email").val());
        console.log("pwd: "+ $("#pwd").val());
        
        if($("#email").val() != "" && $("#pwd").val() != ""){
            var controler = "controle=gestionSession&action=ident";
            var email_content = "login="+$("#email").val();
            var pwd_content = "pwd="+$("#pwd").val();
            $.ajax({
                type: "POST",
                url: "../index.php",
                data: controler+"&"+email_content+"&"+pwd_content,
                success: function(result){
                    if(result == "OK"){
                        controler = "controle=utilisateur&action=dashboard";
                        $(location).attr("href", "../index.php"+"?"+controler+"&"+email_content+"&"+pwd_content);
                    }
                    if(result == "inconnu"){
                        if(confirm("Voulez-vous créer un compte ?")){
                            controler = "controle=gestionSession&action=nouvelUtilisateur";
                            $(location).attr("href", "../index.php"+"?"+controler+"&"+email_content+"&"+pwd_content);
                        } else {
                            $(location).attr("href", "./accueil.html");
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
            alert("haaalo");
        }
    });
    
});
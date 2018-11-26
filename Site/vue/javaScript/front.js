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
                    if(result){
                        alert(result);
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
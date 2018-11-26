$(document).ready(function(){
    
    $(".accueil_form .btn").click(function(){
        console.log("email : "+ $("#email").val());
        console.log("pwd: "+ $("#pwd").val());
        
        if($("#email").val() != "" && $("#pwd").val() != ""){
            $.ajax({
                type: "POST",
                url: "../index.php",
                data: "controle=gestionSession&action=ident&login="+$("#email").val()+"&pwd="+$("#pwd").val(),
                success: function(result){
                    if(result){
                        alert(result);
                    }
                }
            });
        } else {
            alert("haaalo");
        }
    });
    
});
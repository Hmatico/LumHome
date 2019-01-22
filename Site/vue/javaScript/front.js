$(document).ready(function(){
    
    $(".caroussel").ready(function(){
        $(".carousel_img").css('display','none');
        $(".carousel_img").eq(0).css('display','block');
        slideImg(0);        
    });
    
    function slideImg(i){
        setTimeout(function(){
            if(i < $(".carousel_img").length -1)
                i++;
            else i = 0;
            $(".carousel_img").css('display', 'none');
            $(".carousel_img").eq(i).css('display', 'block');
            slideImg(i);
        },3000);
    }
});

	$(".logo_content").hover(function(){
        $(this).css("cursor","pointer");
    })
    
    $(".logo_content").click(function(){
        var page = $(this).attr('id');
        if(page=="lumhome")
            window.location.replace("erreur.html");
        if(page=="nous")
            window.location.replace("erreur.html");
        if(page=="contact")
            window.location.replace("contact.html");
        if(page=="questions")
            window.location.replace("faq.html");
    });
    
    $(".format_info").click(function(){
        $(".modal .modal-content p").html("Le mot de passe doit contenir une minuscule, une majuscule, un chiffre et un caractère spécial au minimum. La taille minimale est de huit caractères.");
        $(".modal").css("display","block");
    });

    $(".close").click(function(){
        $(".modal").css("display","none");
    });

    $(".accordion").click(function(){
        $(".accordion").each(function(){
        if($(this).hasClass("disAble"))
            $(this).toggleClass("disAble");
            this.nextElementSibling.style.maxHeight = null;
        });
        $(this).toggleClass("disAble");
        this.nextElementSibling.style.maxHeight = this.nextElementSibling.scrollHeight + "px";
    });

    $("#form_mail_admin #btn").click(function(){
        $("#nom").css('border-color', '#ccc');
        $("#email").css('border-color', '#ccc');
        $("#object_select").css('border-color', '#ccc');
        $("#message").css('border-color', '#ccc');
        if($("#nom").val() != "" && $("#email").val() != "" && $("#object_select").val() != "" && $("#message").val() != ""){
            var nom = "nom=" + $("#nom").val();
            var email = "mail=" + $("#email").val();
            var controler = "controle=accueil&action=getMail";
            var objet = "obj=" + $("#object_select").val();
            var message = "msg=" + $("#message").val();
            /* Envoi au controler via ajax */
            $.ajax({
                type: "POST",
                url: "../index.php",
                data: controler+"&"+nom+"&"+email+"&"+objet+"&"+message,
                success: function(data){
                    $(".modal .modal-content p").html(data);
                    $(".modal").css("display","block");
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
            if($("#nom").val() == "")
                $("#nom").css('border-color', 'red');
            if($("#email").val() == "")
                $("#email").css('border-color', 'red');
            if($("#object_select").val() == "")
                $("#object_select").css('border-color', 'red');
            if($("#message").val() == "")
                $("#message").css('border-color', 'red');
        }
    });

    $("#site").click(function(){
        $(".modal .modal-content p").prepend("<img src='./resources/Architecture_Site.png' width=100%>");
        $(".modal").css("display","block");
    });
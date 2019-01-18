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

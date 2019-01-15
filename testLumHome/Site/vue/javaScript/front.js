$(document).ready(function(){
    
    
    $(".accordion").click(function(){
        $(".accordion").each(function(){
            if($(this).hasClass("disAble"))
                $(this).toggleClass("disAble");
            this.nextElementSibling.style.maxHeight = null;
        });
        $(this).toggleClass("disAble");
        this.nextElementSibling.style.maxHeight = this.nextElementSibling.scrollHeight + "px";
    });
    
    $(".logo_content").hover(function(){
        $(this).css("cursor","pointer");
    })
    
    $(".logo_content").click(function(){
        var page = $(this).attr('id');
        if(page=="lumhome")
            window.location.replace("faq.html");
        if(page=="nous")
            window.location.replace("faq.html");
        if(page=="contact")
            window.location.replace("contact.html");
        if(page=="questions")
            window.location.replace("faq.html");
    });
    
    $(".format_info").click(function(){
        alert("Le mot de passe doit contenir une minuscule, une majuscule, un chiffre et un caractère spécial au minimum. La taille minimale est de huit caractères.");
    });
});
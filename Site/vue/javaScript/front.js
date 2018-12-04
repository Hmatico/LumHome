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
$('.burger').on('click',function(){
    if($('.layoutNav').hasClass('nav-burger-active'))
    {
        $('.layoutNav').removeClass('nav-burger-active');
        $('.layoutContent').css('padding-left','15rem');
    }else
    {
        $('.layoutNav').addClass('nav-burger-active');
        $('.layoutContent').css('padding-left','0px');
    }
    if($('.linea1').hasClass('toggle1')){$('.linea1').removeClass('toggle1');}else{$('.linea1').addClass('toggle1');}
    if($('.linea2').hasClass('toggle2')){$('.linea2').removeClass('toggle2');}else{$('.linea2').addClass('toggle2');}
    if($('.linea3').hasClass('toggle3')){$('.linea3').removeClass('toggle3');}else{$('.linea3').addClass('toggle3');}

});
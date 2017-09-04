$(document).ready(function () {
    // var triangle = $('.svg-triangle');
    // var w_triangle = $('header').width();
    // var h_triangle = $('header').height();
    // $(triangle).find('polygon').attr({'points': '0 '+ h_triangle +','+ w_triangle +' 0,0,0 '+ h_triangle +' 0'});
    // console.log(w_triangle, h_triangle)
    // $('.shape-container').css({'height':h_triangle + 20});{
    var get_sec_screen = $('.get-sec-screen');
    $(get_sec_screen).on('click',function (e) {
        e.preventDefault();
        $('html,body').animate({scrollTop:$('.screen-second').offset().top},500);
        return false;
    });
    $('#simple-bothie, #screen-fifth__carousel').owlCarousel({
        loop:true,
        nav:true,
        dots:false,
        navText:['<span class="owl-left-icon"></span>','<span class="owl-right-icon"></span>'],
        items:1
    });
    var $container = $('#container');
    // Инициализация Масонри, после загрузки изображений
    $container.imagesLoaded( function() {
        $container.masonry({
            
        });
    });

    $(window).resize(function(){
        middle_layer_fun();
    });
    $(window).trigger('resize');
    function middle_layer_fun() {
        var middle_layer = $('.middle-layer');
        var w_width = $(window).width();
        var w_height = $(window).height();
        // $(middle_layer).css({'width':w_width * 2,'height':w_height * 2})
        $(middle_layer).css({'width':w_width})
    }
    middle_layer_fun();
    $('.eauth-service-link').empty();
    $('.form-label').on('click',function () {
        $(this).toggleClass('checked');    
    });
});
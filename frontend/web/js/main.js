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
        $('html,body').animate({scrollTop:$('.screen-second').offset().top},800);
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
    var bothie_btn = $('.bothie-btn');
    $(bothie_btn).on('click', function (e) {
        e.preventDefault();
        var bothie_rat = $(this).parent().find('.bothie-rat').text();
        var bothie_rat_number = parseInt(bothie_rat);
        bothie_rat_number += 1;
        $(this).parent().find('.bothie-rat').text(bothie_rat_number)
    })
});
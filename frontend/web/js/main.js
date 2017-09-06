$(window).load(function () {
    $('body').removeClass('overflow');
    $('.preloader').fadeOut(300);
    $('.top-layer, .bottom-layer').removeClass('transform');
});
$(document).ready(function () {
    $('.go-to-screen').on('click',function (e) {
        e.preventDefault();
        var target = $(this).attr('href');
        $('html,body').animate({scrollTop:$(target).offset().top},500);
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
        $(middle_layer).css({'width':w_width})
    }
    middle_layer_fun();
    $('.eauth-service-link').empty();
    $('.form-label').on('click',function () {
        $(this).toggleClass('checked');    
    });

    $('.bothie-btn').on('click', function (e) {
        e.preventDefault();

        var obj = $(this);

        $.ajax({
            type: 'GET',
            url: 'site/user-action',
            data: 'id='+obj.attr('data-id'),
            success: function (data) {
                obj.parent().find('.bothie-rat').html(data.score);
                obj.remove();
            }
        });
    });

    var wow = new WOW(
        {
            boxClass: 'wow', // animated element css class (default is wow)
            animateClass: 'animated', // animation css class (default is animated)
            offset: 100, // distance to the element when triggering the animation (default is 0)
            mobile: true,        // trigger animations on mobile devices (true is default)
            callback: function (box) {
                $(box).addClass('w_100');
            },
            scrollContainer: null // optional scroll container selector, otherwise use window
        }
    );
    wow.init();
});
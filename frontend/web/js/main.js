$(window).load(function () {
    $('.preloader').fadeOut(300);
    $('body').removeClass('overflow');
    $('.top-layer, .bottom-layer').removeClass('transform');
    setTimeout(function () {
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
    },300)
});
$(document).ready(function () {

    // var videoStep = document.getElementById("video-step");
    // var video = document.getElementById("video");
    // videoStep.addEventListener("impress:stepenter", function() {
    //     video.play();
    //     alert('play')
    // }, false);
    // videoStep.addEventListener("impress:stepleave", function() {
    //     video.pause();
    //     alert('not-play')
    // }, false);
    
    var url = document.location.href;
    $.each($('.nav a'), function(){
        if(this.href == url){ $(this).addClass('active') }
    });

    $('.go-to-screen').on('click',function (e) {
        e.preventDefault();
        var target = $(this).attr('href');
        $('html,body').animate({scrollTop:($(target).offset().top + 100)},500);
        return false;
    });
    $('#simple-bothie').owlCarousel({
        loop:true,
        nav:true,
        dots:false,
        navText:['<span class="owl-left-icon"></span>','<span class="owl-right-icon"></span>'],
        items:1
    });
    $('#screen-fifth__carousel').owlCarousel({
        loop:false,
        nav:true,
        dots:false,
        navText:['<span class="owl-left-icon"></span>','<span class="owl-right-icon"></span>'],
        responsive:{
            0:{
                items: 1
            }
        }
    });
    var $container = $('#container');
    // Инициализация Масонри, после загрузки изображений
    $container.imagesLoaded( function() {
        $container.masonry({
            itemSelector: '.grid-item',
            percentPosition: true,
            gutter: 40
        });
    });
    $container.on( 'layoutComplete', function( event, items ) {
        console.log( items.length );
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

    $(document).on('click', '.bothie-btn', function (e) {
        e.preventDefault();

        var obj = $(this);

        $.ajax({
            type: 'GET',
            url: '/site/user-action',
            data: 'id='+obj.attr('data-id'),
            success: function (data) {
                obj.parent().find('.bothie-rat').html(data.score);
                obj.remove();
            }
        });
    });
    
    $('.show-menu').click(function () {
        $(this).toggleClass('active');
        $('body').toggleClass('overflow');
        $('.nav').toggleClass('show');
        $('.main-menu__left').toggleClass('fixed');
    });
    
    $('.eauth-service-link').on('click', function (e) {
        if(!$('#conditions').is(':checked') || !$('#rules').is(':checked')) {
            $('.site-login__second span.alert').html('Пожалуйста, подтвердите свое согласие с полными правилами и условиями обработки данных');
            return false;
        } else {
            $('.site-login__second span.alert').html('');
        }
    });

    $(document).on('click', '.login-modal-btn', function() {
        $('#modal-login').modal();
        return false;
    });

    function getShareUrl(obj) {
        if(obj.data('type') == 'vk') {
            url  = 'http://vkontakte.ru/share.php?';
            url += 'url='          + encodeURIComponent(obj.data('url'));
            url += '&title='       + encodeURIComponent(obj.data('title'));
            url += '&text=' + encodeURIComponent(obj.data('desc'));
            url += '&image='       + encodeURIComponent(obj.data('image'));
            url += '&noparse=true';
        } else {
            url  = 'http://www.facebook.com/sharer.php?s=100';
            url += '&p[title]='     + encodeURIComponent(obj.data('title'));
            url += '&p[url]='       + encodeURIComponent(obj.data('url'));
            url += '&p[images][0]=' + encodeURIComponent(obj.data('image'));
            url += '&p[summary]='   + encodeURIComponent(obj.data('desc'));
        }

        return url;
    }

    $('.shares-items a').click(function(e) {
        url = getShareUrl($(this));

        window.open(url,'','toolbar=0,status=0,width=626,height=436');

        return false;
    })
});
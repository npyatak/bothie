<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<div class="rates-page p-relative">
    <div class="top-figure">
        <div class="middle-layer"></div>
    </div>
    <svg class="svg-left" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <rect class="top" x="0" y="0" />
        <image id="image3" x="0" y="-170%" xlink:href="images/backgrounds/bgr.jpg" />
    </svg>
    <div class="rates-content">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-7">
                    <div class="rates-content__inner">
                        <div class="title wow fadeInDown"><img class="img-inBlock" src="images/screen/screen-second-title.png" alt="Title"></div>
                        <p class="text-white wow fadeInUp">Иногда, чтобы показать что-то важное, одной фотографии не достаточно. Поэтому мы придумали бози #bothie для тех, кто не любит ограничений. <br>
                            Делай фото сразу с обеих камер с Nokia 8.</p>
                        <p class="m-t-30 m-b-40 tt-up white-text font-30 wow fadeInUp">
                            Не ограничивайся селфи. Делай бози <br>
                            <span class="tt-normal">bothie #fridaybothie</span><br>
                            <span class="tt-normal">bothie #бозинапятнице</span>
                        </p>
                        <p class="text-white wow fadeInUp">Участвуй в нашем конкурсе и голосуй за лушие фотографии!</p>
                        <div class="links wow fadeInUp">
                            <div><a href="<?=Url::toRoute(['site/how-to-win']);?>" class="simple-link">Как выиграть?</a></div>
                            <div><a href="<?=Url::toRoute(['site/participate']);?>" class="border-link">Участвовать</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($posts):?>
            <div id="container" class="bothie-blocks">
                <?=$this->render('_bothie_blocks', ['posts' => $posts]);?>
            </div>
            <?php endif;?>
        </div>
    </div>
    <div class="rates-footer">
        <div class="container">
            <?php if(!$noMorePosts):?>
            <div class="links text-center wow fadeInUp">
                <div class="loading"><span class="icon"><i class="fa fa-cog fa-spin"></i></span></div>
                <a class="border-link load-more">Загрузить ещё</a>
            </div>
            <?php endif;?>
            <div class="row text-left wow fadeInUp" data-wow-offset="-400">
                <div class="col-md-2">
                    <a href="">Условия обработки персональных данных</a>
                </div>
            </div>
            <?=$this->render('_share_block');?>
        </div>
    </div>
</div>

<?php $script = "
    $('.load-more').on('click', function() {
        var btn = $(this);
        btn.hide();
        btn.parent().find('.loading').show();

        var ids = [];
        $('.grid-item').each(function(el) {
            ids.push($(this).data('id'));
        });

        $.ajax({
            data: {ids: ids},
            success: function(data) {
                var html = $(data);
                $('#container').append(html).masonry('appended', html);

                btn.parent().find('.loading').hide();
                if(data.length == 0) {
                    btn.parent().remove();
                }
            }
        });
    });
";?>
<?php $this->registerJs($script, yii\web\View::POS_END);?>
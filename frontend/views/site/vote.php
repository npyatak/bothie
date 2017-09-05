<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<div class="rates-page">
    <div class="rates-content">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-7">
                    <div class="title"><img class="img-inBlock" src="images/screen/screen-second-title.png" alt="Title"></div>
                    <p class="text-white">Иногда, чтобы показать что-то важное, одной фотографии не достаточно. Поэтому мы придумали бози #bothie для тех, кто не любит ограничений. <br>
                        Делай фото сразу с обеих камер с Nokia 8.</p>
                    <p class="m-t-30 m-b-40 tt-up blue-text font-30">
                        Не ограничивайся селфи. Делай бози <span class="tt-normal">#bothie</span>
                    </p>
                    <p class="text-white">Участвуй в нашем конкурсе и голосуй за лушие фотографии!</p>
                    <div class="links">
                        <div><a href="<?=Url::toRoute(['site/how-to-win']);?>" class="simple-link">Как выиграть?</a></div>
                        <div><a href="<?=Url::toRoute(['site/participate']);?>" class="border-link">Участвовать</a></div>
                    </div>
                </div>
            </div>
            <?php if($posts):?>
            <div class="row">
                <div class="col-md-12">
                    <div class="container">
                        <div id="container" class="bothie-blocks">
                            <?=$this->render('_vote_bothie_blocks', ['posts' => $posts]);?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif;?>
        </div>
    </div>
    <div class="rates-footer">
        <div class="container">
            <div class="links text-center">
                <a href="<?=Url::toRoute(['site/participate']);?>" class="border-link load-more">Загрузить ещё</a>
            </div>
            <div class="row text-left">
                <div class="col-md-2">
                    <a href="">Условия обработки персональных данных</a>
                </div>
            </div>
            <?=$this->render('_share_block');?>
        </div>
    </div>
</div>
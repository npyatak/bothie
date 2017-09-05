<?php 
use yii\helpers\Url;
use yii\helpers\Html;

use common\models\Post;
use common\models\PostAction;
?>

<div class="main-page">
    <header class="p-relative text-center">
        <!--<div class="shape-container">-->
            <!--<div class="shape-top"></div>-->
            <!--<div class="shape-left"></div>-->
        <!--</div>-->
        <!--<svg xmlns="http://www.w3.org/2000/svg" version="1.1" class="svg-triangle">-->
            <!--<polygon points=""/>-->
        <!--</svg>-->
        <div class="content-inner">
            <div class="container">
                <div class="top-figure">
                    <div class="top-layer">
                        <img src="images/items/blue_nokia_8.png" alt="Blue Nokia 8">
                    </div>
                    <div class="middle-layer"></div>
                    <div class="bottom-layer">
                        <img src="images/items/orange_nokia_8_2.png" alt="Orange Nokia 8">
                    </div>
                </div>
                <div class="row buttons">
                    <div class="col-12">
                        <div class="button-wrap">
                            <div><p class="tt-up">Конкурс</p></div>
                            <div class="m-t-30">
                                <span class="get-sec-screen button"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row top justify-content-center">
                    <div class="col-md-6">
                        <h2 class="text-left title-lg m-t-60">Покажи свою <span>историю</span></h2>
                    </div>
                </div>
                <div class="row bottom justify-content-end">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <h2 class="text-right title-lg">С обеих <span>сторон</span></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-footer">
                    <div class="row text-left">
                        <div class="col-md-2">
                            <a href="">Условия обработки персональных данных</a>
                        </div>
                    </div>
                    <?=$this->render('_share_block');?>
                </div>
            </div>
        </div>
    </header>
    <section class="screen-second">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="left">
                        <img class="img-inBlock" src="<?=$currentWeek->imageUrl;?>" alt="Nokia 8">
                        <div class="img-caption">
                            На этой недели: <br>
                            <span><?=$currentWeek->name;?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <div class="top">
                        <img class="img-inBlock" src="images/screen/screen-second-title.png" alt="Screen image">
                    </div>
                    <div class="middle">
                        <p class="top-p">Сделай бози и получи возможность выиграть Nokia 8</p>
                        <div class="links">
                            <div>
                                <a href="<?=Url::toRoute(['site/how-to-win']);?>" class="simple-link">Как выиграть?</a>
                            </div>
                            <div>
                                <a href="<?=Url::toRoute(['site/participate']);?>" class="border-link">Участвовать</a>
                            </div>
                        </div>
                        <p>
                            4 недели - 4 смартфона Nokia 8 <br>
                            Также мы раскажем о 12 лучших авторах в эфире телеканала <br>
                            «Пятница!»
                        </p>
                        <p class="m-t-30 tt-up blue-text font-30">
                            Не ограничивайся селфи. Делай бози <br>
                            <span class="tt-normal">#bothie</span>
                        </p>
                        <div class="button-wrap">
                            <div>
                                <span class="top-button button"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="right">
                        <img class="img-inBlock" src="images/screen/screen-second-right.png" alt="Nokia 8">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="screen-third">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-5">
                    <h2 class="title-lg">Как сделать лучшее бози?</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <div id="simple-bothie" class="owl-carousel owl-theme">
                        <div class="item">
                            <div class="simple-bothie-block">
                                <div class="img-wrap clearfix">
                                    <div class="left" style="background-image:url('images/bothie/bothie-1.jpg')"></div>
                                    <div class="right" style="background-image:url('images/bothie/bothie-2.jpg')"></div>
                                </div>
                                <div class="simple-bothie__content">
                                    <h3 class="title-bothie">1. Следи за солнцем</h3>
                                    <div class="descr-bothie">
                                        <p>Между 5:00 и 7:00 утра наступает время для волшебного света. Солнце пока еще низко, и отсвет от поверхностей получается рассеянным. Самые привычные вещи и стандартные ситуации наполняются слегка потусторонним смыслом.</p>
                                    </div>
                                    <div class="question-bothie">
                                        <p>Хочешь рассказать сказку в своих бози? Жди рассвета!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="simple-bothie-block">
                                <div class="img-wrap clearfix">
                                    <div class="left">
                                        <img src="images/bothie/bothie-1.jpg" alt="Bothie">
                                    </div>
                                    <div class="right">
                                        <img src="images/bothie/bothie-2.jpg" alt="Bothie">
                                    </div>
                                </div>
                                <div class="simple-bothie__content">
                                    <h3 class="title-bothie">1. Следи за солнцем</h3>
                                    <div class="descr-bothie">
                                        <p>Между 5:00 и 7:00 утра наступает время для волшебного света. Солнце пока еще низко, и отсвет от поверхностей получается рассеянным. Самые привычные вещи и стандартные ситуации наполняются слегка потусторонним смыслом.</p>
                                    </div>
                                    <div class="question-bothie">
                                        <p>Хочешь рассказать сказку в своих бози? Жди рассвета!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="simple-bothie-block">
                                <div class="img-wrap clearfix">
                                    <div class="left">
                                        <img src="images/bothie/bothie-1.jpg" alt="Bothie">
                                    </div>
                                    <div class="right">
                                        <img src="images/bothie/bothie-2.jpg" alt="Bothie">
                                    </div>
                                </div>
                                <div class="simple-bothie__content">
                                    <h3 class="title-bothie">1. Следи за солнцем</h3>
                                    <div class="descr-bothie">
                                        <p>Между 5:00 и 7:00 утра наступает время для волшебного света. Солнце пока еще низко, и отсвет от поверхностей получается рассеянным. Самые привычные вещи и стандартные ситуации наполняются слегка потусторонним смыслом.</p>
                                    </div>
                                    <div class="question-bothie">
                                        <p>Хочешь рассказать сказку в своих бози? Жди рассвета!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="screen-fourth">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-7">
                    <div class="title-lg">Работы участников</div>
                    <p class="text-white">Иногда, чтобы показать что-то важное, одной фотографии не достаточно. Поэтому мы придумали бози #bothie для тех, кто не любит ограничений. <br>
                       Делай фото сразу с обеих камер с Nokia 8.</p>
                    <div class="links">
                        <a href="<?=Url::toRoute(['site/participate']);?>" class="border-link">Участвовать</a>
                    </div>
                    <p class="text-white">Участвуй в нашем конкурсе и голосуй за лучшие фотографии!</p>
                </div>
            </div>
            <?php if($posts):?>
            <div class="row">
                <div class="col-md-12">
                    <div id="container" class="bothie-blocks">
                        <?=$this->render('_bothie_blocks', ['posts' => $posts]);?>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-12">
                    <a href="<?=Url::toRoute(['site/vote']);?>" class="border-link">Все работы</a>
                </div>
            </div>
            <?php endif;?>
        </div>
    </section>
    <section class="screen-fifth">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9 text-center">
                    <h2 class="title-lg">Двухсторонняя съемка и прямой эфир в соцсети</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <p class="text-white">Съемка одновременно двумя 13MP камерами – основной и фронтальной. Возможность живой трансляции на FB</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div id="screen-fifth__carousel" class="owl-carousel">
                        <div class="item">
                            <img src="images/screen/screen-fifth__carousel.png" alt="Nokia 8">
                        </div>
                        <div class="item">
                            <img src="images/screen/screen-fifth__carousel.png" alt="Nokia 8">
                        </div>
                        <div class="item">
                            <img src="images/screen/screen-fifth__carousel.png" alt="Nokia 8">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <p class="bottom-p">За яркими впечатлениями к нам!</p>
                    <div class="links text-center">
                        <a href="" class="border-link">Подробнее</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
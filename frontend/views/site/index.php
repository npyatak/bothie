<?php 
use yii\helpers\Url;
use yii\helpers\Html;

use common\models\Post;
use common\models\PostAction;
?>

<div class="main-page">
    <header class="p-relative text-center">
        <div class="content-inner">
            <div class="container">
                <div class="top-figure">
                    <div class="top-layer transform">
                        <img src="images/items/blue_nokia_8.png" alt="Blue Nokia 8">
                    </div>
                    <div class="middle-layer"></div>
                    <div class="bottom-layer transform">
                        <img src="images/items/orange_nokia_8_2.png" alt="Orange Nokia 8">
                    </div>
                </div>
                <div class="row buttons">
                    <div class="col-12">
                        <div class="button-wrap wow fadeInDown" data-wow-duration=".4s" data-wow-delay="1.6s">
                            <div><p class="tt-up">Конкурс</p></div>
                            <div class="m-t-30">
                                <a href="#second-screen" class="go-to-screen button"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row top justify-content-center">
                    <div class="col-md-6">
                        <h2 class="text-left title-lg m-t-60  wow fadeInLeft" data-wow-duration=".8s" data-wow-delay=".8s">Покажи свою <span>историю</span></h2>
                    </div>
                </div>
                <div class="row bottom justify-content-end">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <h2 class="text-right title-lg wow fadeInRight" data-wow-duration=".8s" data-wow-delay="1.1s" data-wow-offset="-100">С обеих <span>сторон</span></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-footer wow fadeInUp">
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
    <section id="second-screen" class="screen-second">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="left wow fadeInLeft">
                        <img class="img-inBlock" src="<?=$currentWeek->imageUrl;?>" alt="Nokia 8">
                        <div class="img-caption">
                            На этой недели: <br>
                            <span><?=$currentWeek->name;?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <div class="top wow fadeInUp">
                        <img class="img-inBlock" src="images/screen/screen-second-title.png" alt="Screen image">
                    </div>
                    <div class="middle wow fadeInUp">
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
                                <a href="#third-screen" class="go-to-screen top-button button"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="right wow fadeInRight">
                        <img class="img-inBlock" src="images/screen/screen-second-right.png" alt="Nokia 8">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="third-screen" class="screen-third">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-5 wow fadeInUp">
                    <h2 class="title-lg">Как сделать лучшее бози?</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-9 wow fadeInUp">
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
                <div class="col-md-7 wow fadeInUp">
                    <div class="title-lg">Работы участников</div>
                    <p class="text-white">Иногда, чтобы показать что-то важное, одной фотографии не достаточно. Поэтому мы придумали бози #bothie для тех, кто не любит ограничений. <br>
                       Делай фото сразу с обеих камер с Nokia 8.</p>
                    <div class="links">
                        <a href="<?=Url::toRoute(['site/participate']);?>" class="border-link">Участвовать</a>
                    </div>
                    <p class="text-white">Участвуй в нашем конкурсе и голосуй за лучшие фотографии!</p>
                </div>
            </div>
            <div id="container" class="bothie-blocks wow fadeInUp">
                <div class="grid-item w280-h600">
                    <div class="bothie-instargram" style="background-image:url('images/test/280x560.jpg')"></div>
                    <a href="" class="bothie-btn"><span class="icon"></span></a>
                    <span class="bothie-rat">1235</span>
                </div>
                <div class="grid-item w280-h280">
                    <div class="bothie-instargram" style="background-image:url('images/test/280.jpg')"></div>
                    <a href="" class="bothie-btn"><span class="icon"></span></a>
                    <span class="bothie-rat">1235</span>
                </div>
                <div class="grid-item w600-h280">
                    <div class="bothie-instargram" style="background-image:url('images/test/560x280.jpg')"></div>
                    <a href="" class="bothie-btn"><span class="icon"></span></a>
                    <span class="bothie-rat">1235</span>
                </div>
                <div class="grid-item w280-h280">
                    <div class="bothie-instargram" style="background-image:url('images/test/280.jpg')"></div>
                    <a href="" class="bothie-btn"><span class="icon"></span></a>
                    <span class="bothie-rat">1235</span>
                </div>
                <div class="grid-item w280-h280">
                    <div class="bothie-instargram" style="background-image:url('images/test/280.jpg')"></div>
                    <a href="" class="bothie-btn"><span class="icon"></span></a>
                    <span class="bothie-rat">1235</span>
                </div>
                <div class="grid-item w600-h280">
                    <div class="bothie-instargram" style="background-image:url('images/test/560x280.jpg')"></div>
                    <a href="" class="bothie-btn"><span class="icon"></span></a>
                    <span class="bothie-rat">1235</span>
                </div>
                <div class="grid-item w280-h600">
                    <div class="bothie-instargram" style="background-image:url('images/test/280x560.jpg')"></div>
                    <a href="" class="bothie-btn"><span class="icon"></span></a>
                    <span class="bothie-rat">1235</span>
                </div>
                <div class="grid-item w280-h280">
                    <div class="bothie-instargram" style="background-image:url('images/test/280.jpg')"></div>
                    <a href="" class="bothie-btn"><span class="icon"></span></a>
                    <span class="bothie-rat">1235</span>
                </div>
                <div class="grid-item w280-h280">
                    <div class="bothie-instargram" style="background-image:url('images/test/280.jpg')"></div>
                    <a href="" class="bothie-btn"><span class="icon"></span></a>
                    <span class="bothie-rat">1235</span>
                </div>
                <div class="grid-item w280-h280">
                    <div class="bothie-instargram" style="background-image:url('images/test/280.jpg')"></div>
                    <a href="" class="bothie-btn"><span class="icon"></span></a>
                    <span class="bothie-rat">1235</span>
                </div>
                <div class="grid-item w600-h280">
                    <div class="bothie-instargram" style="background-image:url('images/test/560x280.jpg')"></div>
                    <a href="" class="bothie-btn"><span class="icon"></span></a>
                    <span class="bothie-rat">1235</span>
                </div>
                <div class="grid-item w280-h280">
                    <div class="bothie-instargram" style="background-image:url('images/test/280.jpg')"></div>
                    <a href="" class="bothie-btn"><span class="icon"></span></a>
                    <span class="bothie-rat">1235</span>
                </div>
                <div class="grid-item w600-h280">
                    <div class="bothie-instargram" style="background-image:url('images/test/560x280.jpg')"></div>
                    <a href="" class="bothie-btn"><span class="icon"></span></a>
                    <span class="bothie-rat">1235</span>
                </div>
                <div class="grid-item w280-h280">
                    <div class="bothie-instargram" style="background-image:url('images/test/280.jpg')"></div>
                    <a href="" class="bothie-btn"><span class="icon"></span></a>
                    <span class="bothie-rat">1235</span>
                </div>
                <div class="grid-item w280-h280">
                    <div class="bothie-instargram" style="background-image:url('images/test/280.jpg')"></div>
                    <a href="" class="bothie-btn"><span class="icon"></span></a>
                    <span class="bothie-rat">1235</span>
                </div>
                <div class="grid-item w280-h280">
                    <div class="bothie-instargram" style="background-image:url('images/test/280.jpg')"></div>
                    <a href="" class="bothie-btn"><span class="icon"></span></a>
                    <span class="bothie-rat">1235</span>
                </div>
                <div class="grid-item w280-h280">
                    <div class="bothie-instargram" style="background-image:url('images/test/280.jpg')"></div>
                    <a href="" class="bothie-btn"><span class="icon"></span></a>
                    <span class="bothie-rat">1235</span>
                </div>
                <div class="grid-item w600-h280">
                    <div class="bothie-instargram" style="background-image:url('images/test/560x280.jpg')"></div>
                    <a href="" class="bothie-btn"><span class="icon"></span></a>
                    <span class="bothie-rat">1235</span>
                </div>
                <div class="grid-item w280-h280">
                    <div class="bothie-instargram" style="background-image:url('images/test/280.jpg')"></div>
                    <a href="" class="bothie-btn"><span class="icon"></span></a>
                    <span class="bothie-rat">1235</span>
                </div>
                <div class="grid-item w280-h280">
                    <div class="bothie-instargram" style="background-image:url('images/test/280.jpg')"></div>
                    <a href="" class="bothie-btn"><span class="icon"></span></a>
                    <span class="bothie-rat">1235</span>
                </div>
                <div class="grid-item w600-h280">
                    <div class="bothie-site-horizontal">
                        <div class="first" style="background-image: url('images/bothie/bothie-3.jpg')"></div>
                        <div class="second" style="background-image: url('images/bothie/bothie-3-2.jpg')"></div>
                    </div>
                    <a href="" class="bothie-btn"><span class="icon"></span></a>
                    <span class="bothie-rat">1235</span>
                </div>
                <div class="grid-item w280-h600">
                    <div class="bothie-site-vertical">
                        <div class="first" style="background-image: url('images/bothie/bothie-4-2.jpg')"></div>
                        <div class="second" style="background-image: url('images/bothie/bothie-4.jpg')"></div>
                    </div>
                    <a href="" class="bothie-btn"><span class="icon"></span></a>
                    <span class="bothie-rat">1235</span>
                </div>
                <div class="grid-item w280-h280">
                    <div class="bothie-instargram" style="background-image:url('images/test/280.jpg')"></div>
                    <a href="" class="bothie-btn"><span class="icon"></span></a>
                    <span class="bothie-rat">1235</span>
                </div>
            </div>
<!--            --><?php //if($posts):?>
<!--            <div class="row">-->
<!--                <div class="col-md-12 wow fadeInUp">-->
<!--                    <div id="container" class="bothie-blocks">-->
<!--                        --><?//=$this->render('_bothie_blocks', ['posts' => $posts]);?>
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="row text-center">-->
<!--                <div class="col-12 wow fadeInUp">-->
<!--                    <a href="--><?//=Url::toRoute(['site/vote']);?><!--" class="border-link">Все работы</a>-->
<!--                </div>-->
<!--            </div>-->
<!--            --><?php //endif;?>
        </div>
    </section>
    <section class="screen-fifth">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9 text-center wow fadeInUp">
                    <h2 class="title-lg">Двухсторонняя съемка и прямой эфир в соцсети</h2>
                </div>
            </div>
            <div class="row justify-content-center wow fadeInUp">
                <div class="col-md-6 text-center">
                    <p class="text-white">Съемка одновременно двумя 13MP камерами – основной и фронтальной. Возможность живой трансляции на FB</p>
                </div>
            </div>
            <div class="row justify-content-center wow fadeInUp">
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
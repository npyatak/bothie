<?php 
use yii\helpers\Url;
use yii\helpers\Html;
?>

<div class="how-to-win text-center">
    <div class="container">
        <div class="how-to-win__inner">
            <div class="how-to-win__first">
                <div class="top">
                    <div class="top__title-first"></div>
                    <div class="top__title-second">
                        <h2 class="title-lg">Как выиграть?</h2>
                    </div>
                </div>
                <div class="middle">
                    <?=$this->render('_weeks_menu', ['weeks' => $weeks]);?>
                </div>
                <div class="bottom m-t-40">
                    <p class="white-text">Иногда, чтобы показать что-то важное, одной фотографии не достаточно. Поэтому мы придумали бози #bothie для тех, кто не любит ограничений. Делай фото сразу с обеих камер с Nokia 8.</p>
                    <p class="m-t-30 m-b-40 tt-up blue-text font-30">Не ограничивайся селфи. Делай бози <span class="tt-normal">#bothie</span></p>
                    <p class="white-text">Участвуй в нашем конкурсе и голосуй за лучшие фотографии!</p>
                </div>
                <div class="week-type">
                    <div class="week-type__item">
                        <div class="week-type__img">
                            <?=Html::img($currentWeek->imageUrl, ['alt' => 'Nokia 8 #bothie']);?>
                        </div>
                        <div class="week-type__text"><?=$currentWeek->number;?> неделя:<br>тема<br><?=$currentWeek->name;?></div>
                    </div>
                </div>
            </div>
            <div class="how-to-win__second">
                <div class="left"></div>
                <div class="right"></div>
                <div class="week-steps">
                    <div class="step-item">
                        <h2 class="title-lg">1 вариант:</h2>
                        <hr class="hr">
                        <?=$currentWeek->description_1;?>
                    </div>
                    <div class="step-item">
                        <h2 class="title-lg">2 вариант:</h2>
                        <hr class="hr">
                        <?=$currentWeek->description_2;?>
                    </div>
                    <div class="step-item">
                        <h2 class="title-lg">Награды:</h2>
                        <hr class="hr">
                        <p>Жюри из ТОП-30 выберет три лучших работы и расскажет об аккаунтах авторов<br>
                            в эфире<br>
                            insta-top телеканала «Пятница!»<br>
                            Автор лучшей работы получит Nokia 8</p>
                    </div>
                </div>
                <a href="<?=Url::toRoute(['site/participate']);?>" class="border-link">Участвовать</a>
            </div>
        </div>
    </div>
</div>
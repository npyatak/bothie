<?php 
use yii\helpers\Url;
use yii\helpers\Html;
?>

<div class="how-to-win text-center">
    <div class="container">
        <div class="how-to-win__inner">
            <div class="how-to-win__first">
                <div class="top">
                    <div class="top__title-first wow fadeInDown"></div>
                    <div class="top__title-second wow fadeInUp">
                        <h2 class="title-lg">Победители</h2>
                    </div>
                </div>
                <div class="week-type winners wow fadeInUp">
                    <?php foreach ($weeks as $week):?>
                        <?php if($week->isFinished() && $week->winners != ''):?>
                        <div class="week-type__item">
                            <div class="week-type__img">
                                <?=Html::img($week->imageUrl, ['alt' => 'Nokia 8 #bothie']);?>
                            </div>
                            <div class="week-type__text"><?=$week->number;?> этап:<br>тема<br><?=$week->name;?></div>
                        </div>
                        <div class="desc">
                            <?=$week->winners;?>
                        </div>
                        <hr class="hr">
                        <?php endif;?>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div>
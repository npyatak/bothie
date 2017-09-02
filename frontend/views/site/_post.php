<?php 
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\widgets\share\ShareWidget;
?>

<div class="other-jobs__item">
    <div class="top">
        <div class="left" style="background-image: url(<?=$post->frontImageUrl;?>)"></div>
        <div class="right" style="background-image: url(<?=$post->backImageUrl;?>"></div>
    </div>
    <div class="bottom">
        <div class="o-j__rating">
            <h4>Твои баллы: <span><?=$post->score;?></span></h4>
        </div>
        <div class="o-j__shares">
            <?=ShareWidget::widget(['post'=>$post]);?>
        </div>
    </div>
</div>
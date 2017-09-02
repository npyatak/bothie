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
            <h4>Твои баллы: <?=$post->score;?></h4>
        </div>
        <div class="o-j__shares">
            <?=ShareWidget::widget([
                'id' => $post->id,
                'url' => Url::to($post->url, true),
                'title' => 'Короли Bothie',
                'image' => $post->frontImageUrl,
                'desc' => 'Поддержи мою работу в конкурсе',
            ]);?>
        </div>
    </div>
</div>
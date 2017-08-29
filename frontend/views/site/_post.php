<?php 
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\widgets\share\ShareWidget;
?>

<div>
    <?=Html::img($post->frontImageUrl);?>
    <?=Html::img($post->backImageUrl);?>
    <div>
        <?=ShareWidget::widget([
            'id' => $post->id,
            'url' => Url::to($post->url, true),
            'title' => 'Короли Bothie',
            'image' => $post->frontImageUrl,
            'desc' => 'Поддержи мою работу в конкурсе',
        ]);?>
    </div>
</div>
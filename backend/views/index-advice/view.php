<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\IndexAdvice */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Советы на главной', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="index-advice-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'image_1',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::img($model->image1Url);
                }
            ],
            [
                'attribute' => 'image_2',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::img($model->image2Url);
                }
            ],
            'order',
            'title',
            'link',
            [
                'attribute' => 'text',
                'format' => 'raw',
            ],
            [
                'attribute' => 'question',
                'format' => 'raw',
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->statusLabel;
                }
            ],
        ],
    ]) ?>

</div>

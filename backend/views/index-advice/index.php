<?php

use yii\helpers\Html;
use yii\grid\GridView;

use common\models\IndexAdvice;

$this->title = 'Советы на главной';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="index-advice-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить совет', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'order',
            'title',
            [
                'attribute' => 'status',
                'value' => function($data) {
                    return $data->statusLabel;
                },
                'filter' => Html::activeDropDownList($searchModel, 'status', IndexAdvice::getStatusArray(), ['prompt'=>'']),
            ],
            [
                'attribute' => 'image_2',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::img($model->image2Url, ['style'=>'width: 150px;']);
                }
            ],
            [
                'attribute' => 'image_2',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::img($model->image2Url, ['style'=>'width: 150px;']);
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

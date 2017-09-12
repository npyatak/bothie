<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Страницы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="week-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить страницу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'=>function($model){
            if($model->status === get_class($model)::STATUS_INACTIVE) {
                return ['class' => 'danger'];
            }
        },
        'columns' => [
            'id',
            'url',
            'title',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($data) {
                    return $data->getStatusArray()[$data->status];
                },
                'filter' => function($model) {
                    Html::activeDropDownList($searchModel, 'status', $model->statusArray, ['prompt'=>'']);
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        $url = Yii::$app->urlManagerFrontEnd->createUrl(['page/'.$model->url]);
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, []);
                    },
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;

use common\models\Post;
use common\models\Week;

$this->title = 'Посты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'rowOptions' => function($model) {
                if($model->status === Post::STATUS_BANNED) {
                    return ['class' => 'danger'];
                }
            },
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                [
                    'attribute' => 'week_id',
                    'value' => function($data) {
                        return $data->week->name;
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'week_id', ArrayHelper::map(Week::find()->all(), 'id', 'name'), ['prompt'=>'']),
                ],
                [
                    'attribute' => 'user_id',
                    'value' => function($data) {
                        return $data->user->username;
                    }
                ],
                [
                    'attribute' => 'front_image',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Html::img($data->frontImageUrl, ['width' => '200px']);
                    }
                ],
                [
                    'attribute' => 'back_image',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Html::img($data->backImageUrl, ['width' => '200px']);
                    }
                ],
                'score',
                [
                    'attribute' => 'status',
                    'value' => function($data) {
                        return $data->statusLabel;
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'status', Post::getStatusArray(), ['prompt'=>'']),
                ],
                [
                    'attribute' => 'created_at',
                    'value' => function($data) {
                        return date('d.m.Y H:i', $data->created_at);
                    }
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {ban} {delete}',
                    'buttons' => [
                        'ban' => function ($url, $model) {
                            $url = Url::toRoute(['/post/ban', 'id'=>$model->id]);
                            return $model->status === Post::STATUS_ACTIVE ? Html::a('<span class="glyphicon glyphicon-remove-sign"></span>', $url, ['title' => 'Забанить']) : Html::a('<span class="glyphicon glyphicon-ok-sign"></span>', $url, ['title' => 'Вернуть из бана']);
                        },
                    ],
                ],
            ],
        ]); ?>
    <?php Pjax::end(); ?>
</div>

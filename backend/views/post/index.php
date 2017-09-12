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
                    'format' => 'raw',
                    'value' => function($data) {
                        return Html::a($data->week->name, Url::toRoute(['week/view', 'id' => $data->week_id]));
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'week_id', ArrayHelper::map(Week::find()->all(), 'id', 'name'), ['prompt'=>'']),
                ],
                [
                    'attribute' => 'user_id',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Html::a($data->user->fullName ? $data->user->fullName : $data->user->id, Url::toRoute(['user/view', 'id' => $data->id]));
                    }
                ],
                [
                    'attribute' => 'is_from_ig',
                    'value' => function($data) {
                        $arr = [0 => 'Нет', 1 => 'Да'];
                        return $arr[$data->is_from_ig];
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'is_from_ig', [0 => 'Нет', 1 => 'Да'], ['prompt'=>'']),
                ],
                [
                    'header' => 'Изображения',
                    'format' => 'raw',
                    'value' => function($data) {
                        if($data->is_from_ig) {
                            switch ($data->image_orientation) {
                                case Post::IMAGE_SQUARE:
                                    $style = 'width: 140px; height: 140px';
                                    break;
                                case Post::IMAGE_HORIZONTAL:
                                    $style = 'width: 300px; height: 140px';
                                    break;
                                case Post::IMAGE_VERTICAL:
                                    $style = 'width: 140px; height: 300px';
                                    break;
                            }

                            return Html::img($data->igImageUrl, ['style' => $style]);
                        } else {
                            return Html::img($data->frontImageUrl, ['width' => '140px']).Html::img($data->backImageUrl, ['width' => '140px']);
                        }
                    }
                ],
                [
                    'attribute' => 'score',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Html::a($data->score, Url::toRoute(['post-action/index', 'PostActionSearch[post_id]' => $data->id]));
                    },
                ], 
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

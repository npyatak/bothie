<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use common\models\PostAction;

$this->title = 'Действия';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'created_at',
                    'value' => function($data) {
                        return date('d.m.Y H:i', $data->created_at);
                    }
                ],
                [
                    'attribute' => 'post_id',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Html::a($data->post->id, Url::toRoute(['post/view', 'id'=>$data->post->id]));
                    }
                ],
                [
                    'attribute' => 'user_id',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Html::a($data->user->fullName ? $data->user->fullName : $data->user_id, Url::toRoute(['user/view', 'id' => $data->user_id]));
                    }
                ],
                [
                    'attribute' => 'type',
                    'value' => function($data) {
                        return $data->typeLabel;
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'type', PostAction::getTypeArray(), ['prompt'=>'']),
                ],
                'score',

                /*[
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {ban} {delete}',
                    'buttons' => [
                        'ban' => function ($url, $model) {
                            $url = Url::toRoute(['/post/ban', 'id'=>$model->id]);
                            return $model->status === get_class($model)::STATUS_ACTIVE ? Html::a('<span class="glyphicon glyphicon-remove-sign"></span>', $url, ['title' => 'Забанить']) : Html::a('<span class="glyphicon glyphicon-ok-sign"></span>', $url, ['title' => 'Вернуть из бана']);
                        },
                    ],
                ],*/
            ],
        ]); ?>
    <?php Pjax::end(); ?>
</div>

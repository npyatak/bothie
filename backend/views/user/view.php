<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'soc',
            'sid',
            'name',
            'surname',
            'ig_id',
            [
                'attribute' => 'ig_username',
                'format' => 'raw',
                'value' => function($data) {
                    if($data->ig_username) {
                        return Html::a($data->ig_username, 'https://instagram.com/'.$data->ig_username);
                    }
                }
            ],
            [
                'attribute' => 'image',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::img($model->image);
                }
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->statusLabel;
                }
            ],
            'ip',
            'browser',
            [
                'attribute' => 'created_at',
                'value' => function($model) {
                    return date('d.m.Y H:i', $model->created_at);
                }
            ],
            [
                'attribute' => 'updated_at',
                'value' => function($model) {
                    return date('d.m.Y H:i', $model->updated_at);
                }
            ],
        ],
    ]) ?>

</div>

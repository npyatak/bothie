<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

use common\models\Post;

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Посты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Ban', ['ban', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
                'attribute' => 'user_id',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::a($model->user->username ? $model->user->username : $model->user->ig_id, Url::toRoute(['/user/view', 'id'=>$model->user->id]));
                }
            ],  
            [
                'attribute' => 'week_id',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::a($model->week->name, Url::toRoute(['week/view', 'id' => $model->week_id]));
                },
            ],
            [
                'attribute' => 'is_from_ig',
                'value' => function($model) {
                    $arr = [0 => 'Нет', 1 => 'Да'];
                    return $arr[$model->is_from_ig];
                },
            ],
            [
                'attribute' => 'image',
                'format' => 'raw',
                'value' => function($model) {
                    if($model->is_from_ig) {
                        switch ($model->image_orientation) {
                            case Post::IMAGE_SQUARE:
                                $style = 'width: 280px; height: 280px';
                                break;
                            case Post::IMAGE_HORIZONTAL:
                                $style = 'width: 600px; height: 280px';
                                break;
                            case Post::IMAGE_VERTICAL:
                                $style = 'width: 280px; height: 600px';
                                break;
                        }

                        return Html::img($model->igImageUrl, ['style' => $style]);
                    } else {
                        return Html::img($model->frontImageUrl, ['width' => '280px']).Html::img($model->backImageUrl, ['width' => '280px']);
                    }
                }
            ],
            [
                'attribute' => 'score',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::a($model->score, Url::toRoute(['post-action/index', 'PostActionSearch[post_id]' => $model->id]));
                },
            ],            
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->statusLabel;
                }
            ],
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

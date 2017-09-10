<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\IndexAdvice */

$this->title = 'Изменить совет: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Советы на главной', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="index-advice-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

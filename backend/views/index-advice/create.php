<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\IndexAdvice */

$this->title = 'Добавить совет';
$this->params['breadcrumbs'][] = ['label' => 'Советы на главной', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="index-advice-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

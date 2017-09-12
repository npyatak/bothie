<?php

use yii\helpers\Html;

$this->title = 'Изменить страницу' .': '. $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Страницы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>

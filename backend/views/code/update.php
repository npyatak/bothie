<?php

use yii\helpers\Html;

$this->title = 'Обновить код: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Сторонние коды', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name];
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
            </div>
            <div class="box-body">
				<?= $this->render('_form', [
					'model' => $model,
				]) ?>
			</div>
		</div>
	</div>
</div>

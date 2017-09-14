<?php

use yii\helpers\Html;

$this->title = 'Добавить код';
$this->params['breadcrumbs'][] = ['label' => 'Сторониие коды', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
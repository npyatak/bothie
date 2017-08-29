<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Week */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="week-form">

    <?php $form = ActiveForm::begin([
    	'options' => ['enctype' => 'multipart/form-data'],
    	//'enableClientValidation'=>false
    ]); ?>

    <?=$form->field($model, "frontImageFile")->widget(frontend\widgets\cropimage\ImageCropSection::className(), [
            'form' => $form,
            'options' => [
                'id' => 'front_image_file',
                'class' => 'hidden',
            ],
            'attribute_x'=>'front_x',
            'attribute_y'=>'front_y',
            'attribute_width'=>'front_w',
            'attribute_height'=>'front_h',
            'attribute_scale'=>'front_scale',
            'attribute_angle'=>'front_angle',
            //'attribute_remove'=>'front_remove',
            'class_block'=>'center-block',
            'plugin_options' => [
                'width' => 250,
                'height' => 250,
                'id_input_file' => 'front_image_file',
                'section' => 'front'
            ],
            'template_image'=> isset($model->id) && $model->getImageUrl($model->id,false) ? Html::img($model->getImageUrl($model->id),$model::IMAGE_WIDGET_CONFIGS['section1']) : null
    ])->label(false);?>


    <?=$form->field($model, "backImageFile")->widget(frontend\widgets\cropimage\ImageCropSection::className(), [
            'form' => $form,
            'options' => [
                'id' => 'back_image_file',
                'class' => 'hidden',
            ],
            'attribute_x'=>'back_x',
            'attribute_y'=>'back_y',
            'attribute_width'=>'back_w',
            'attribute_height'=>'back_h',
            'attribute_scale'=>'back_scale',
            'attribute_angle'=>'back_angle',
            //'attribute_remove'=>'back_remove',
            'class_block'=>'center-block',
            'plugin_options' => [
                'width' => 250,
                'height' => 250,
                'id_input_file' => 'back_image_file',
                'section' => 'back'
            ],
            'template_image'=> isset($model->id) && $model->getImageUrl($model->id,false) ? Html::img($model->getImageUrl($model->id),$model::IMAGE_WIDGET_CONFIGS['section1']) : null
    ])->label(false);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php foreach (Yii::$app->user->identity->posts as $post):?>
    <?=$this->render('_post', ['post' => $post]);?>
<?php endforeach;?>
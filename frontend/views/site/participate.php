<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="main-page">
    <?php $form = ActiveForm::begin([
    	'options' => [
            'enctype' => 'multipart/form-data',
            'id' => 'post-image-form'
        ],
    	//'enableClientValidation'=>false
    ]); ?>

        <?=$form->field($model, "frontImageFile")->widget(frontend\widgets\cropimage\ImageCropSection::className(), [
                'form' => $form,
                'options' => [
                    'id' => 'post-frontimagefile',
                    'class' => 'hidden',
                ],
                'attribute_x'=>'front_x',
                'attribute_y'=>'front_y',
                'attribute_width'=>'front_w',
                'attribute_height'=>'front_h',
                'attribute_scale'=>'front_scale',
                'attribute_angle'=>'front_angle',
                'class_block'=>'center-block',
                'plugin_options' => [
                    'width' => Yii::$app->params['postImageSize']['width'],
                    'height' => Yii::$app->params['postImageSize']['height'],
                    'id_input_file' => 'post-frontimagefile',
                    'section' => 'front'
                ],
                'template_image'=> isset($model->id) && $model->getImageUrl($model->id,false) ? Html::img($model->getImageUrl($model->id),$model::IMAGE_WIDGET_CONFIGS['section1']) : null
        ])->label(false);?>


        <?=$form->field($model, "backImageFile")->widget(frontend\widgets\cropimage\ImageCropSection::className(), [
                'form' => $form,
                'options' => [
                    'id' => 'post-backimagefile',
                    'class' => 'hidden',
                ],
                'attribute_x'=>'back_x',
                'attribute_y'=>'back_y',
                'attribute_width'=>'back_w',
                'attribute_height'=>'back_h',
                'attribute_scale'=>'back_scale',
                'attribute_angle'=>'back_angle',
                'class_block'=>'center-block',
                'plugin_options' => [
                    'width' => Yii::$app->params['postImageSize']['width'],
                    'height' => Yii::$app->params['postImageSize']['height'],
                    'id_input_file' => 'post-backimagefile',
                    'section' => 'back'
                ],
                'template_image'=> isset($model->id) && $model->getImageUrl($model->id,false) ? Html::img($model->getImageUrl($model->id),$model::IMAGE_WIDGET_CONFIGS['section1']) : null
        ])->label(false);?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>

    <?php foreach (Yii::$app->user->identity->posts as $post):?>
        <?=$this->render('_post', ['post' => $post]);?>
    <?php endforeach;?>
</div>
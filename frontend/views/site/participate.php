<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="personal-account">
    <div class="personal-account__inner">
        <div class="p-a__first text-center">
            <h2 class="title-lg">Iron_sanya</h2>
            <div class="p-a_links-week">
                <div class="first-week">
                    <a href="">1 неделя foodporn</a>
                </div>
                <div class="second-week">
                    <a href="" class="active">2 неделя beauty</a>
                </div>
                <div class="third-week">
                    <a href="javascript:void(0)" class="disabled">3 неделя wellness</a>
                </div>
                <div class="fourth-week">
                    <a href="javascript:void(0)" class="disabled">4 неделя moms&kids</a>
                </div>
            </div>
            <div class="p-a__title"></div>
            <hr class="hr">
            <div class="do-it-bothie">
                <?php $form = ActiveForm::begin([
                    'options' => [
                        'enctype' => 'multipart/form-data',
                        'id' => 'post-image-form'
                    ],
                    //'enableClientValidation'=>false
                ]); ?>
                <div class="row">
                    <div class="col-6">
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
                    </div>
                    <div class="col-6">
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
                    </div>
                </div>
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
                <?php foreach (Yii::$app->user->identity->posts as $post):?>
                    <?=$this->render('_post', ['post' => $post]);?>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>
        
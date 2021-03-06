<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="personal-account">
    <div class="personal-account__inner">
        <div class="p-a__first text-center">
            <h2 class="title-lg wow fadeInDown"><?=Yii::$app->user->identity->fullName;?></h2>
            <div class="wow fadeInUp">
                <?=$this->render('_weeks_menu', ['weeks' => $weeks]);?>
            </div>
            <div class="p-a__title wow fadeInUp"></div>
            <hr class="hr">
            <div class="do-it-bothie wow fadeInUp">
                <?php if(!Yii::$app->user->identity->ig_id):?>
                    <?php 
                    $user = Yii::$app->user->identity;
                    $form = ActiveForm::begin([
                        'id' => 'form-signup',
                        'action' => '/site/missing-fields',
                        'enableAjaxValidation'=>true,
                    ]); ?>
                        <br>
                        <h4>Для участия в конкурсе необходимо заполнить ваш логин Инстаграма.</h4>

                        <div class="input">
                            <?= $form->field($user, 'ig_username')->textInput(['class' => 'form-control'])->label(false);?>
                        </div>

                        <div class="modal-button">
                            <?= Html::submitButton('Подтвердить', ['class' => 'border-link']) ?>
                        </div>
                                
                    <?php ActiveForm::end(); ?>
                <?php elseif($currentWeek == null):?>
                    <h4>Голосование закрыто. Пожалуйста, дождитесь нового этапа конкурса.</h4>
                <?php else:?>
                <h3 class="do-it-bothie__title">Сделай бози:</h3>
                <?php $form = ActiveForm::begin([
                    'options' => [
                        'enctype' => 'multipart/form-data',
                        'id' => 'post-image-form',
                        'no-validate' => ''
                    ],
                    //'enableClientValidation'=>false
                ]); ?>

                <div class="row">
                    <div class="col-6">
                        <?=$form->field($model, "frontImageFile")->widget(frontend\widgets\cropimage\ImageCropSection::className(), [
                            'form' => $form,
                            'label' => $currentWeek->hint_1,
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
                            'label' => $currentWeek->hint_2,
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

                <div class="loading">
                    <span class="icon"><i class="fa fa-cog fa-spin"></i></span>
                    <span class="loading-text">Идёт загрузка...</span>
                </div>
                <div class="form-group buttons">
                    <?= Html::submitButton('Готово', ['class' =>'border-link']) ?>
                    <br>
                    <?=Html::a('Как выиграть?', Url::toRoute(['site/how-to-win']), ['class' => 'simple-link']);?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <hr class="hr">
            <?php endif;?>
        </div>


        <?php if(count(Yii::$app->user->identity->posts) > 0):?>
        <div class="p-a__second wow fadeInUp">
            <div class="other-jobs">
                <h2 class="title-lg text-center">Другие работы:</h2>
                <div class="other-jobs__items">
                    <?php foreach (Yii::$app->user->identity->posts as $post):?>
                        <?=$this->render('_user_post', ['post' => $post]);?>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
        <?php endif;?>
    </div>
</div>
        
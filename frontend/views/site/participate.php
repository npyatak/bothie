<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use common\models\Week;
?>
<div class="personal-account">
    <div class="personal-account__inner">
        <div class="p-a__first text-center">
            <h2 class="title-lg"><?=Yii::$app->user->identity->full_name;?></h2>
            <div class="p-a_links-week">
                <?php foreach ($weeks as $week):?>
                <div>
                    <?php switch ($week->status) {
                        case Week::STATUS_ACTIVE;
                            $class = 'active';
                            break;
                        case Week::STATUS_WAITING;
                            $class = 'disabled';
                            break;                          
                        default:
                            $class = '';
                            break;
                    }?>
                    <a href="" class="<?=$class;?>"><?=$week->number;?> неделя <?=$week->name;?></a>
                </div>
                <?php endforeach;?>
            </div>
            <div class="p-a__title"></div>
            <hr class="hr">
            <div class="do-it-bothie">
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
                    <?= Html::submitButton('Готово', ['class' =>'border-link']) ?>
                    <br>
                    <?=Html::a('Как выиграть?', Url::toRoute(['site/rules']), ['class' => 'simple-link']);?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <hr class="hr">
        </div>


        <?php if(count(Yii::$app->user->identity->posts) > 0):?>
        <div class="p-a__second">
            <div class="other-jobs">
                <h2 class="title-lg text-center">Другие работы:</h2>
                <div class="other-jobs__items">
                    <?php foreach (Yii::$app->user->identity->posts as $post):?>
                        <?=$this->render('_post', ['post' => $post]);?>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
        <?php endif;?>
    </div>
</div>
        
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use mihaildev\ckeditor\CKEditor;
?>

<div class="add-form">
    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'label' => false,
                'wrapper' => 'form-container',
            ],
        ]
    ]);?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'full',
        ],
    ]);
    ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList($model->statusArray, ['class'=>'']) ?>

    <div class="add-form-buttons">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn green-btn save-btn']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

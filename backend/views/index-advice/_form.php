<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use common\components\CustomCKEditor;
?>

<div class="index-advice-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order')->textInput() ?>

    <?= $form->field($model, 'imageFile1')->fileInput() ?>

    <?= $form->field($model, 'imageFile2')->fileInput() ?>


    <?= $form->field($model, 'text')->widget(CustomCKEditor::className(),[
        'editorOptions' => [
            'preset' => 'tiny',
        ],
    ]);
    ?>

    <?= $form->field($model, 'question')->widget(CustomCKEditor::className(),[
        'editorOptions' => [
            'preset' => 'tiny',
        ],
    ]);
    ?>

    <?= $form->field($model, 'status')->dropDownList($model->statusArray, ['class'=>'']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

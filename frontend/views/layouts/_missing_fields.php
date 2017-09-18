<?php 
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;

$user = Yii::$app->user->identity;

yii\bootstrap\Modal::begin([
    'id' => 'modal-form',
    'size' => 'modal-md',
    //keeps from closing modal with esc key or by clicking out of the modal.
    // user must click cancel or X to close
    'clientOptions' => [
        'backdrop' => 'static', 
        'keyboard' => false,
        'show' => true,
    ],
    'closeButton' => false,
    //'header' => '<div class="modal-header-shadow"></div><div class="logo"><img src="/img/logo.png" alt=""></div>',
    //'header' => '<div class="head-bg"><div class="head-bg-img"></div><div class="head-bg-content"><div class="logo"><img src="/img/logo.png" alt=""></div></div></div>'

]);
?>

<div id='modalContent' class="be-large-post-align">
    <?php $form = ActiveForm::begin([
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
</div>
<?php yii\bootstrap\Modal::end();?>

<style type="text/css">
    #modal-form {
        padding-top: 100px;
    }
    #modalContent {
        padding: 40px 0;
        text-align: center;
    }
    #modalContent h4 {
        color: #fff;
    }
    #modalContent .input {
        margin: 40px auto;
    }
    #modalContent input {
        position: relative;
        width: 300px;
        height: 50px;
        opacity: 1;
        font-size: 25px;
        margin: auto;
    }
    .fade {
        opacity: 1;
        background-color: #fff;
    }
</style>
<?php 
use yii\helpers\Html;
use yii\bootstrap\Modal;

Yii::$app->assetManager->bundles = [
    'yii\bootstrap\BootstrapPluginAsset' => false,
    'yii\bootstrap\BootstrapAsset' => false,
];

yii\bootstrap\Modal::begin([
    'id' => 'modal-login',
    'size' => 'modal-md',
    'header' => null,
    'closeButton' => false,
]);
?>

<div id="modalContent">
    <div class="site-login__first text-center">
        <?php echo \nodge\eauth\Widget::widget(['action' => 'site/login']); ?>
        <br>
        <p>Авторизуйся, используя свой аккаунт в Instagram</p>
    </div>
    <div class="site-login__second">
        <span class="alert"></span>
        <hr class="hr">
        <form action="">
            <div class="form-group">
                <div class="left">
                    <label for="conditions" class="form-label"></label>
                    <input id="conditions" type="checkbox" class="form-control">
                </div>
                <div class="right">
                    <p>Я согласен с условиями обработки данных</p>
                </div>
            </div>
            <div class="form-group">
                <div class="left">
                    <label for="rules" class="form-label"></label>
                    <input id="rules" type="checkbox" class="form-control">
                </div>
                <div class="right">
                    <p>Я согласен с полными правами</p>
                </div>
            </div>
        </form>
    </div>
</div>
<?php yii\bootstrap\Modal::end();?>
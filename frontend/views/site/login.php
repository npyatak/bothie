<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Авторизация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="site-login__inner">
        <div class="site-login__first text-center">
            <h2 class="title-lg"><?= Html::encode($this->title) ?></h2>
            <?php echo \nodge\eauth\Widget::widget(['action' => 'site/login']); ?>
            <p>Авторизуйся, используя свой аккаунт в Instagram</p>
        </div>
        <div class="site-login__second">
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
</div>

<?php $script = "
    $('.eauth-service-link').on('click', function (e) {
        if(!$('#conditions').is(':checked') || !$('#rules').is(':checked')) {
            $('.site-login__second').prepend('<span class=text-danger>Пожалуйста, подтвердите свое согласие с полными правилами и условиями обработки данных</span>');
            return false;
        }
    });
";?>

<?php $this->registerJs($script, yii\web\View::POS_END);?>
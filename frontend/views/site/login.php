<?php
use yii\helpers\Html;

$this->title = 'Авторизация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="site-login__inner">
        <div class="site-login__first text-center">
            <h2 class="title-lg"><?= Html::encode($this->title) ?></h2>
            <?php echo \frontend\widgets\social\SocialWidget::widget(['action' => 'site/login']); ?>
            <p>Авторизуйся, используя свой аккаунт в Вконтакте или Facebook</p>
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
                        <p>Я согласен с полными правилами</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
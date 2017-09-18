<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>

<div class="site-login__first text-center">
    <h2 class="title-lg"><?= Html::encode($this->title) ?></h2>
    <?php echo \frontend\widgets\social\SocialWidget::widget(['action' => 'site/login']); ?>
    <p>Авторизуйся, используя один из аккаунтов соц.сетей</p>
</div>
<div class="site-login__second">
    <span class="alert"></span>
    <hr class="hr">
    <form action="">
        <div class="form-group">
            <div class="left">
                <label for="conditions" class="form-label checked"></label>
                <input id="conditions" type="checkbox" checked="checked" class="form-control">
            </div>
            <div class="right">
                <p>Авторизуясь, я согласен с  <a href="<?=Url::to(['page/personal-info-rules']);?>">условиями обработки данных</a></p>
            </div>
        </div>
        <div class="form-group">
            <div class="left">
                <label for="rules" class="form-label checked"></label>
                <input id="rules" type="checkbox" checked="checked" class="form-control">
            </div>
            <div class="right">
                <p>Авторизуясь, я согласен с   <a href="<?=Url::to(['page/rules']);?>">полными правилами</a></p>
            </div>
        </div>
    </form>
</div>
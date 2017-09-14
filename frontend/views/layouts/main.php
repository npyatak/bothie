<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= $this->title ? Html::encode($this->title) : 'Nokia 8: покажи свою историю с обеих сторон';?></title>
    <?php $this->head() ?>
</head>
<body class="overflow">
<?php $this->beginBody() ?>
<div class="preloader"><span class="icon"><i class="fa fa-cog fa-spin"></i></span></div>
<div class="wrapper">
    <div class="main-menu">
        <div class="main-menu__inner">
            <div class="container">
                <div class="row">
                    <div class="col-3">
                        <div class="main-menu__left">
                            <a href="http://friday.ru" target="_blank"></a>
                        </div>
                    </div>
                    <div class="col-6">
                        <?php
                        $menuItems = [
                            ['label' => 'Главная', 'url' => Url::toRoute(['site/index'])],
                            ['label' => 'Участвовать', 'url' => Url::toRoute(['site/participate'])],
                            ['label' => 'Голосовать', 'url' => Url::toRoute(['site/vote'])],
                            ['label' => 'Правила', 'url' => Url::to(['page/rules'])],
                        ];
                        ?>
                        <div class="nav">
                            <ul class="ul">
                                <?php foreach ($menuItems as $item):?>
                                    <li><?=Html::a($item['label'], $item['url'], ['class' => Yii::$app->controller->action->id === $item['action'] ? 'active' : '']);?></li>
                                <?php endforeach;?>
                                <?php if (Yii::$app->user->isGuest):?>
                                    <li><?=Html::a('Войти', Url::toRoute(['site/login']), ['class' => Yii::$app->controller->action->id === $item['action']]);?></li>
                                <?php else:?>
                                    <li><?=Html::beginForm(['/site/logout'], 'post');?>
                                        <?=Html::submitButton(
                                            'Выйти'
                                        )?>
                                        <?=Html::endForm();?>
                                    </li>
                                <?php endif;?>
                            </ul>
                        </div>
                        <div class="hidden-btn">
                            <span class="show-menu">
                                <span class="show-menu__inner">
                                    <span></span><span></span><span></span>
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="main-menu__right">
                            <a href="https://mobileshop.nokia.ru/378450/nokia-8-tempered-blue" target="_blank"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <?= $content ?>
    </div>
    <footer>
        
    </footer>
</div>

<?= Alert::widget([
    'options' => ['class' => 'error-sign-in']
]) ?>

<?php if(Yii::$app->user->isGuest) {
    echo $this->render('_login_modal');
} elseif(!Yii::$app->user->identity->ig_id) {
    echo $this->render('_missing_fields');
}?>

<?php if($_SERVER['HTTP_HOST'] != 'bothie.local') {
    $codes = \common\models\Code::find()->all();
    if($codes) {
        foreach ($codes as $code) {
            echo $code->body;
        }
    }
} ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

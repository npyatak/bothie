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
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrapper">
    <div class="main-menu">
        <div class="main-menu__inner">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="main-menu__left">
                            <a href=""></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <?php
                        $menuItems = [
                            ['label' => 'Главная', 'action' => 'index'],
                            ['label' => 'Участвовать', 'action' => 'participate'],
                            ['label' => 'Голосовать', 'action' => 'vote'],
                            ['label' => 'Правила', 'action' => 'rules'],
                        ];
                        ?>
                        <div class="nav">
                            <ul class="ul">
                                <?php foreach ($menuItems as $item):?>
                                    <li><?=Html::a($item['label'], Url::toRoute(['site/'.$item['action']]), ['class' => Yii::$app->controller->action->id === $item['action'] ? 'active' : '']);?></li>
                                <?php endforeach;?>
                                <!-- <?php if (Yii::$app->user->isGuest):?>
                                    <li><?=Html::a('Войти', Url::toRoute(['site/login']), ['class' => Yii::$app->controller->action->id === $item['action']]);?></li>
                                <?php else:?>
                                    <li><?=Html::beginForm(['/site/logout'], 'post');?>
                                        <?=Html::submitButton(
                                            'Выйти (' . Yii::$app->user->identity->full_name . ')',
                                            ['class' => 'btn btn-link logout']
                                        )?>
                                        <?=Html::endForm();?>
                                    </li>
                                <?php endif;?> -->
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="main-menu__right">
                            <a href=""></a>
                        </div>
                    </div>
                </div>
                <div class="main-menu__center"></div>
            </div>
        </div>
    </div>
    <div class="content">
        <?= $content ?>
    </div>
    <footer>

    </footer>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

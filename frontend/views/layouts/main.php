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
<body class="overflow">
<?php $this->beginBody() ?>
<img src="http://r.mail.ru/r/4166?btype=show&gpmddealid=21924799&puid1=61&puid2=1&%random%" style="width:0;height:0;position:absolute;visibility:hidden;" alt=""/>
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

<?php if(Yii::$app->user->isGuest) {
    echo $this->render('_login_modal');
} elseif(!Yii::$app->user->identity->ig_id) {
    echo $this->render('_missing_fields');
}?>

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
(function (d, w, c) {
(w[c] = w[c] || []).push(function() {
try {
w.yaCounter45939705 = new Ya.Metrika({
id:45939705,
clickmap:true,
trackLinks:true,
accurateTrackBounce:true,
webvisor:true
});
} catch(e) { }
});

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = "https://mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/45939705" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-106401721-1', 'auto');
    ga('send', 'pageview');
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

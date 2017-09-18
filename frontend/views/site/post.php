<?php
use yii\helpers\Url;
use yii\helpers\Html;

use common\models\Post;
use common\models\PostAction;
?>
<?php $this->title = 'Nokia 8: покажи свою историю с обеих сторон';?>
<?php
if($userPost->is_from_ig) {
    $image = $userPost->igImageUrl;
} else {
    $image = Url::to($userPost->gluedImageUrl, true);
}

$url = Url::canonical();
$desc = 'Голосуйте за меня и участвуйте в конурсе #fridaybothie #бозинапятнице #bothie';

$this->registerMetaTag(['property' => 'og:description', 'content' => $desc], 'og:description');
$this->registerMetaTag(['property' => 'og:title', 'content' => $this->title], 'og:title');
$this->registerMetaTag(['property' => 'og:image', 'content' => $image], 'og:image');
$this->registerMetaTag(['property' => 'og:url', 'content' => $url], 'og:url');
$this->registerMetaTag(['property' => 'og:type', 'content' => 'website'], 'og:type');
$this->registerMetaTag(['property' => 'fb:app_id', 'content' => '1704949819546160'], 'fb:app_id');
?>

<div class="vote-page">
    <div class="vote-page__first">
        <div class="container">
            <div class="vote-page__first-inner">
                <h2 class="title-lg text-center"><?=Yii::$app->user->identity->name;?></h2>
                <div class="vote-item">
                    <div class="top">
                        <?php if(!$userPost->is_from_ig):?>
                            <div class="left" style="background-image: url(<?=$userPost->frontImageUrl;?>)"></div>
                            <div class="right" style="background-image: url(<?=$userPost->backImageUrl;?>"></div>
                        <?php else:?>
                            <div class="<?=$userPost->cssClass;?>" style="background-image: url(<?=$userPost->igImageUrl;?>)"></div>
                        <?php endif;?>
                    </div>
                    <div class="middle">
                        <h4>Баллы: <span><?=$userPost->score;?></span></h4>
                        <p>Увеличь шансы участника на победу, голосуй!</p>
                    </div>
                    <div class="bottom">
                        <a href="<?=Url::toRoute(['site/vote']);?>" class="vote-button"><span>Голосовать</span></a>
                    </div>
                </div>
                <div class="section-bottom text-center">
                    <hr class="hr">
                    <div class="links">
                        <div><a href="<?=Url::toRoute(['site/participate']);?>" class="border-link">Участвовать</a></div>
                        <div><a href="<?=Url::toRoute(['site/how-to-win']);?>" class="simple-link">Как выиграть?</a></div>
                    </div>
                    <hr class="hr">
                </div>
            </div>
        </div>
    </div>
    <?php if($posts):?>
    <div class="vote-page__second">
        <div class="container">
            <div class="vote-page__second-inner">
                <div class="row justify-content-center text-center">
                    <div class="title-lg">Другие участники:</div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div id="container" class="bothie-blocks">
                            <?=$this->render('_bothie_blocks', ['posts' => $posts]);?>
                        </div>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-12">
                        <a href="<?=Url::toRoute(['site/vote']);?>" class="border-link">Все работы</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif;?>
</div>
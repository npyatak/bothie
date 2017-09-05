<?php
use yii\helpers\Url;
use yii\helpers\Html;

use common\models\Post;
use common\models\PostAction;
?>

<?php $this->title = 'Пост';?>

<div class="vote-page">
    <div class="vote-page__first">
        <div class="container">
            <div class="vote-page__first-inner">
                <h2 class="title-lg text-center"><?=Yii::$app->user->identity->name;?></h2>
                <div class="vote-item">
                    <div class="top">
                        <div class="left" style="background-image: url(<?=$userPost->frontImageUrl;?>);?>"></div>
                        <div class="right" style="background-image: url(<?=$userPost->backImageUrl;?>)"></div>
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
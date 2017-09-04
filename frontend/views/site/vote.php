<?php
use yii\helpers\Url;
use yii\helpers\Html;

use common\models\PostAction;
?>

<?php $this->title = 'Голосовать';?>

<div class="vote-page">
    <div class="vote-page__first">
        <div class="container">
            <div class="vote-page__first-inner">
                <h2 class="title-lg text-center">Iron_sanya</h2>
                <div class="vote-item">
                    <div class="top">
                        <div class="left" style="background-image: url('images/bothie/bothie-9-2.jpg')"></div>
                        <div class="right" style="background-image: url('images/bothie/bothie-9.jpg')"></div>
                    </div>
                    <div class="middle">
                        <h4>Баллы: 1234</h4>
                        <p>Увеличь шансы участника на победу, голосуй!</p>
                    </div>
                    <div class="bottom">
                        <a href="" class="vote-button"><span>Голосовать</span></a>
                    </div>
                </div>
                <div class="section-bottom text-center">
                    <hr class="hr">
                    <div class="links">
                        <div><a href="" class="border-link">Участвовать</a></div>
                        <div><a href="" class="simple-link">Как выиграть?</a></div>
                    </div>
                    <hr class="hr">
                </div>
            </div>
        </div>
    </div>
    <div class="vote-page__second">
        <div class="container">
            <div class="vote-page__second-inner">
                <div class="row justify-content-center text-center">
                    <div class="title-lg">Другие участники:</div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div id="container" class="bothie-blocks">
                            <div class="item">
                                <div class="bothie-vertical bothie-wrap">
                                    <div class="top bothie" style="background-image:url('images/bothie/bothie-3.jpg')"></div>
                                    <div class="bottom bothie" style="background-image:url('images/bothie/bothie-3-2.jpg')"></div>
                                    <a href="" class="bothie-btn"><span class="icon"></span></a>
                                    <span class="bothie-rat">1235</span>
                                </div>
                            </div>
                            <div class="item w2 text-center">
                                <div class="bothie-horizontal bothie-wrap">
                                    <div class="left bothie" style="background-image:url('images/bothie/bothie-4.jpg')"></div>
                                    <div class="right bothie" style="background-image:url('images/bothie/bothie-4-2.jpg')"></div>
                                    <a href="" class="bothie-btn"><span class="icon"></span></a>
                                    <span class="bothie-rat">1235</span>
                                </div>
                                <div class="bothie-horizontal bothie-wrap">
                                    <div class="left bothie" style="background-image:url('images/bothie/bothie-5-2.jpg')"></div>
                                    <div class="right bothie" style="background-image:url('images/bothie/bothie-5.jpg')"></div>
                                    <a href="" class="bothie-btn"><span class="icon"></span></a>
                                    <span class="bothie-rat">1235</span>
                                </div>
                            </div>
                            <div class="item text-right">
                                <div class="bothie-vertical bothie-wrap">
                                    <div class="top bothie" style="background-image:url('images/bothie/bothie-6.jpg')"></div>
                                    <div class="bottom bothie" style="background-image:url('images/bothie/bothie-6-2.jpg')"></div>
                                    <a href="" class="bothie-btn"><span class="icon"></span></a>
                                    <span class="bothie-rat">1235</span>
                                </div>
                            </div>
                            <div class="item">
                                <div class="bothie-vertical bothie-wrap">
                                    <div class="top bothie" style="background-image:url('images/bothie/bothie-7.jpg')"></div>
                                    <div class="bottom bothie" style="background-image:url('images/bothie/bothie-7-2.jpg')"></div>
                                    <a href="" class="bothie-btn"><span class="icon"></span></a>
                                    <span class="bothie-rat">1235</span>
                                </div>
                            </div>
                            <div class="item w2">
                                <div class="bothie-vertical-wrap">
                                    <div class="bothie-vertical bothie-wrap">
                                        <div class="top bothie" style="background-image:url('images/bothie/bothie-8.jpg')"></div>
                                        <div class="bottom bothie" style="background-image:url('images/bothie/bothie-8-2.jpg')"></div>
                                        <a href="" class="bothie-btn"><span class="icon"></span></a>
                                        <span class="bothie-rat">1235</span>
                                    </div>
                                    <div class="bothie-vertical bothie-wrap">
                                        <div class="top bothie" style="background-image:url('images/bothie/bothie-9.jpg')"></div>
                                        <div class="bottom bothie" style="background-image:url('images/bothie/bothie-9-2.jpg')"></div>
                                        <a href="" class="bothie-btn"><span class="icon"></span></a>
                                        <span class="bothie-rat">1235</span>
                                    </div>
                                </div>
                            </div>
                            <div class="item text-right">
                                <div class="bothie-vertical bothie-wrap">
                                    <div class="top bothie" style="background-image:url('images/bothie/bothie-10.jpg')"></div>
                                    <div class="bottom bothie" style="background-image:url('images/bothie/bothie-10-2.jpg')"></div>
                                    <a href="" class="bothie-btn"><span class="icon"></span></a>
                                    <span class="bothie-rat">1235</span>
                                </div>
                            </div>
                            <div class="item">
                                <div class="bothie-vertical bothie-wrap">
                                    <div class="top bothie" style="background-image:url('images/bothie/bothie-11.jpg')"></div>
                                    <div class="bottom bothie" style="background-image:url('images/bothie/bothie-11-2.jpg')"></div>
                                    <a href="" class="bothie-btn"><span class="icon"></span></a>
                                    <span class="bothie-rat">1235</span>
                                </div>
                            </div>
                            <div class="item w2 text-center">
                                <div class="bothie-horizontal bothie-wrap">
                                    <div class="left bothie" style="background-image:url('images/bothie/bothie-12-2.jpg')"></div>
                                    <div class="right bothie" style="background-image:url('images/bothie/bothie-12.jpg')"></div>
                                    <a href="" class="bothie-btn"><span class="icon"></span></a>
                                    <span class="bothie-rat">1235</span>
                                </div>
                                <div class="bothie-horizontal bothie-wrap">
                                    <div class="left bothie" style="background-image:url('images/bothie/bothie-13.jpg')"></div>
                                    <div class="right bothie" style="background-image:url('images/bothie/bothie-13-2.jpg')"></div>
                                    <a href="" class="bothie-btn"><span class="icon"></span></a>
                                    <span class="bothie-rat">1235</span>
                                </div>
                            </div>
                            <div class="item text-right">
                                <div class="bothie-vertical bothie-wrap">
                                    <div class="top bothie" style="background-image:url('images/bothie/bothie-14.jpg')"></div>
                                    <div class="bottom bothie" style="background-image:url('images/bothie/bothie-14-2.jpg')"></div>
                                    <a href="" class="bothie-btn"><span class="icon"></span></a>
                                    <span class="bothie-rat">1235</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-12">
                        <a href="" class="border-link">Все работы</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php foreach ($posts as $post):?>
        <div>
            <?=Html::img('/uploads/post/'.$post['user_id'].'/'.$post['front_image']);?>
            <?=Html::img('/uploads/post/'.$post['user_id'].'/'.$post['back_image']);?>

            <?php if(!Yii::$app->user->isGuest):?>
                <?=Html::button('vote', [
                    'class'=>'btn btn-primary vote-button',
                    'data-id'=>$post['id'],
                    'disabled' => !PostAction::userCanDo($post['last_user_action_time'])
                ]);?>
            <?php endif;?>
            <span class="score"><?=$post['score'];?></span>
        </div>
        <br>
    <?php endforeach;?>
</div>
<?php $script = "
    $('.vote-button').click(function(){
        var obj = $(this);
        $.ajax({
            type: 'GET',
            url: '".Url::toRoute(['site/user-action'])."',
            data: 'id='+obj.attr('data-id'),
            success: function (data) {
                obj.parent().find('span').html(data.score);
            }
        });
    });
";?>
<?php $this->registerJs($script, yii\web\View::POS_END);?>
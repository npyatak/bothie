<?php
use yii\helpers\Url;
use yii\helpers\Html;

use common\models\PostAction;
?>

<?php $this->title = 'Голосовать';?>

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
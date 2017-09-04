<?php 
use yii\helpers\Html;

use common\models\PostAction;
?>

<?php if(!Yii::$app->user->isGuest):?>
    <?=Html::a('<span class="icon"></span>', null, [
        'class'=>'bothie-btn',
        'data-id'=>$post->id, 
        'disabled' => !$post->userCan(PostAction::TYPE_LIKE) ? 'disabled' : '',
    ]);?>
<?php endif;?>
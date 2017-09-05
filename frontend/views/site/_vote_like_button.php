 <?php 
use yii\helpers\Html;

use common\models\PostAction;
?>

<?php if(!Yii::$app->user->isGuest && $post->userCan(PostAction::TYPE_LIKE)):?>
    <?=Html::a('<span>Like!</span>', null, [
        'class' => 'bothie-btn rates-btn',
        'data-id' => $post->id, 
    ]);?>
<?php endif;?>
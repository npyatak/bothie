<?php 
use yii\helpers\Html;

use common\models\PostAction;
?>

<?php if(!Yii::$app->user->isGuest && $post->userCan(PostAction::TYPE_LIKE)):?>
    <?=Html::a('<span class="icon"></span>', null, [
        'class' => 'bothie-btn',
        'data-id' => $post->id, 
    ]);?>
<?php endif;?>
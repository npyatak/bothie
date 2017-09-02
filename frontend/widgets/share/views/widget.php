<?php 
use yii\helpers\Html;
use common\models\PostAction;
?>

<p>Увеличь свои шансы на победу, поделись своим бози в соцсетях:</p>

<?=Html::a('<i class="fa fa-facebook"></i>', null, [
	'data-type' => 'fb',
	'data-id' => $post->id,
	'data-url' => $url,
	'data-title' => $title,
	'data-image' => $image,
	'data-desc' => $desc,
	'class' => 'fb shares-link',
	'disabled' => !$post->userCan(PostAction::TYPE_SHARE_FB) ? 'disabled' : '',
]);?>

<?=Html::a('<i class="fa fa-vk"></i>', null, [
	'data-type' => 'vk',
	'data-id' => $post->id,
	'data-url' => $url,
	'data-title' => $title,
	'data-image' => $image,
	'data-desc' => $desc,
	'class' => 'vk shares-link',
	'disabled' => !$post->userCan(PostAction::TYPE_SHARE_VK) ? 'disabled' : '',
]);?>
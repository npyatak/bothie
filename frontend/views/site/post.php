<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\widgets\share\ShareWidget;
?>
<?php
$this->title = 'Короли Bothie';
// $this->registerMetaTag([
//     'name' => 'description',
//     'content' => 'Поддержи мою работу в конкурсе',
// ]);
// $this->registerMetaTag([
//     'name' => 'og:title',
//     'content' => 'Короли Bothie',
// ]);
// $this->registerMetaTag([
//     'name' => 'og:image',
//     'content' => $post->frontImageUrl,
// ]);
// $this->registerMetaTag([
//     'name' => 'og:description',
//     'content' => 'Поддержи мою работу в конкурсе',
// ]);
// $this->registerMetaTag([
//     'name' => 'og:type',
//     'content' => 'article',
// ]);
// $this->registerMetaTag([
//     'name' => 'og:url',
//     'content' => Url::to($post->url, true),
// ]);
?>

	<?//=Html::a('share', 'https://www.facebook.com/sharer/sharer.php?u='.Url::to($post->url, true));?>

<?=Html::img($post->frontImageUrl);?>
<?=Html::img($post->backImageUrl);?>

<?php if(!Yii::$app->user->isGuest && Yii::$app->user->id === $post->user_id):?>
	<?=ShareWidget::widget([
	    'id' => $post->id,
	    'url' => Url::to($post->url, true),
	    'title' => $this->title,
	    'image' => $post->gluedImageUrl,
	    'desc' => 'Поддержи мою работу в конкурсе',
	]);?>
<?php endif;?>
<?php 
use yii\helpers\Url;
use yii\helpers\Html;
?>
<?php 
$url = Url::to(['site/index'], true);
$imageUrl = Url::toRoute(['images/items/share.png'], true);
$title = 'Nokia 8: покажи свою историю с обеих сторон';
$desc = 'Создай свое бози и выигрывай Nokia 8 #fridaybothie #бозинапятнице #bothie';

$this->registerMetaTag(['name' => 'og:description', 'content' => $desc], 'og:description');
$this->registerMetaTag(['name' => 'og:title', 'content' => $title], 'og:title');
$this->registerMetaTag(['name' => 'og:image', 'content' => $imageUrl], 'og:image');
$this->registerMetaTag(['name' => 'og:type', 'content' => 'website'], 'og:type');
?>

<div class="shares text-center">
    <div class="shares-title">
        <span>Нравится проект?</span>
    </div>
    <div class="shares-items">
        <ul>
            <li>
                <?=Html::a('<i class="fa fa-facebook"></i>', '', [
                    'data-type' => 'fb',
                    'data-url' => $url,
                    'data-title' => $title,
                    'data-image' => $imageUrl,
                    'data-desc' => $desc,
                ]);?>
            </li>
            <li>
                <?=Html::a('<i class="fa fa-vk"></i>', '', [
                    'data-type' => 'vk',
                    'data-url' => $url,
                    'data-title' => $title,
                    'data-image' => $imageUrl,
                    'data-desc' => $desc,
                ]);?>
            </li>
        </ul>
    </div>
</div>
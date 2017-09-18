<?php 
use yii\helpers\Url;
use yii\helpers\Html;
?>
<?php 
$url = Url::canonical();
$imageUrl = Url::toRoute(['images/items/share.png'], true);
$title = 'Nokia 8: покажи свою историю с обеих сторон';
$desc = 'Создай свое бози и выиграй Nokia 8 #fridaybothie #бозинапятнице #bothie';

$this->registerMetaTag(['property' => 'og:description', 'content' => $desc], 'og:description');
$this->registerMetaTag(['property' => 'og:title', 'content' => $title], 'og:title');
$this->registerMetaTag(['property' => 'og:image', 'content' => $imageUrl], 'og:image');
$this->registerMetaTag(['property' => 'og:url', 'content' => $url], 'og:url');
$this->registerMetaTag(['property' => 'og:type', 'content' => 'website'], 'og:type');
$this->registerMetaTag(['property' => 'fb:app_id', 'content' => '1704949819546160'], 'fb:app_id');

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
<?php 
use yii\helpers\Url;
?>
<?php 
$url = rawurlencode(Url::to(['site/index'], true));
$imageUrl = rawurlencode(Url::toRoute(['images/items/share.png'], true));
$title = rawurlencode('Nokia 8: покажи свою историю с обеих сторон');
$text = rawurlencode('Создай свое бози и выигрывай Nokia 8 #fridaybothie #бозинапятнице #bothie');
?>

<div class="shares text-center">
    <div class="shares-title">
        <span>Нравится проект?</span>
    </div>
    <div class="shares-items">
        <ul>
            <li>
                <a href='http://www.facebook.com/sharer.php?s=100&p[url]=<?=$url;?>&p[title]=<?=$title;?>&p[images][0]=<?=$imageUrl;?>&p[summary]=<?=$text;?>'>
                    <i class="fa fa-facebook"></i>
                </a>
                <a href="https://www.facebook.com/dialog/feed?app_id=1704949819546160&display=popup&name=<?=$title;?>&picture=<?=$imageUrl;?>&link=<?=$url;?>&description=<?=$text;?>">
                    feed
                </a>
            </li>
            <li>
                <a href="http://vkontakte.ru/share.php?title=<?=$title;?>&text=<?=$text;?>&image=<?=$imageUrl;?>&noparse=true">
                    <i class="fa fa-vk"></i>
                </a>
            </li>
        </ul>
    </div>
</div>
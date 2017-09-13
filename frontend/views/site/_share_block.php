<?php 
use yii\helpers\Url;
?>
<?php 
$imageUrl = Url::toRoute(['images/share.png'], true);
$title = 'Nokia 8: покажи свою историю с обеих сторон';
$text = 'Создай свое бози и выигрывай Nokia 8 fridaybothie бозинапятнице bothie';
?>

<div class="shares text-center">
    <div class="shares-title">
        <span>Нравится проект?</span>
    </div>
    <div class="shares-items">
        <ul>
            <li>
                <a href='http://www.facebook.com/sharer.php?s=100&p[title]=<?=$title;?>&p[summary]=<?=$text;?>&p[images][0]=<?=$imageUrl;?>'>
                    <i class="fa fa-facebook"></i>
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
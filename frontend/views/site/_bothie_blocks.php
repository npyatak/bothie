<?php
use common\models\Post;
?>

<?php foreach ($posts as $post):?>
    <?php if($post->is_from_ig):?>
        <?php switch ($post->image_orientation) {
            case Post::IMAGE_SQUARE:
                $class = 'w280-h280';
                break;
            case Post::IMAGE_HORIZONTAL:
                $class = 'w600-h280';
                break;
            case Post::IMAGE_VERTICAL:
                $class = 'w280-h600';
                break;
        }?>

        <div class="grid-item <?=$class;?>" data-id="<?=$post->id;?>">
            <div class="bothie-instargram" style="background-image:url(<?=$post->igImageUrl;?>)"></div>
            <?=$this->render('_like_button', ['post' => $post]);?>
            <span class="bothie-rat"><?=$post->score;?></span>
        </div>
    <?php else:?>
        <?php $rand = rand(0, 1);
        $class = $rand == 0 ? 'w600-h280' : 'w280-h600';
        $orientClass = $rand == 0 ? 'horizontal' : 'vertical';
        ?>
        <div class="grid-item <?=$class;?>" data-id="<?=$post->id;?>">
            <div class="bothie-site-<?=$orientClass;?>">
                <div class="first" style="background-image: url(<?=$post->frontImageUrl;?>)"></div>
                <div class="second" style="background-image: url(<?=$post->backImageUrl;?>)"></div>
            </div>
            <?=$this->render('_like_button', ['post' => $post]);?>
            <span class="bothie-rat"><?=$post->score;?></span>
        </div>
    <?php endif;?>
<?php endforeach;?>
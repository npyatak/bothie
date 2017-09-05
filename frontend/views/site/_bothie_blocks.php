<?php $key = 1;
foreach ($posts as $post):?>
    <?php if($key % 4 == 1):?>
        <div class="item">
            <div class="bothie-vertical bothie-wrap">
                <div class="top bothie" style="background-image:url(<?=$post->frontImageUrl;?>)"></div>
                <div class="bottom bothie" style="background-image:url(<?=$post->backImageUrl;?>)"></div>
                <?=$this->render('_like_button', ['post' => $post]);?>
                <span class="bothie-rat"><?=$post->score;?></span>
            </div>
        </div>
    <?php elseif($key % 4 == 2):?>
        <div class="item w2 text-center">
            <div class="bothie-horizontal bothie-wrap">
                <div class="left bothie" style="background-image:url(<?=$post->frontImageUrl;?>)"></div>
                <div class="right bothie" style="background-image:url(<?=$post->backImageUrl;?>)"></div>
                <?=$this->render('_like_button', ['post' => $post]);?>
                <span class="bothie-rat"><?=$post->score;?></span>
            </div>
        <?php if($key == count($posts)):?>
        </div>
        <?php endif;?>
    <?php elseif($key % 4 == 3):?>
            <div class="bothie-horizontal bothie-wrap">
                <div class="left bothie" style="background-image:url(<?=$post->frontImageUrl;?>)"></div>
                <div class="right bothie" style="background-image:url(<?=$post->backImageUrl;?>)"></div>
                <?=$this->render('_like_button', ['post' => $post]);?>
                <span class="bothie-rat"><?=$post->score;?></span>
            </div>
        </div>
    <?php else:?>
        <div class="item text-right">
            <div class="bothie-vertical bothie-wrap">
                <div class="top bothie" style="background-image:url(<?=$post->frontImageUrl;?>)"></div>
                <div class="bottom bothie" style="background-image:url(<?=$post->backImageUrl;?>)"></div>
                <?=$this->render('_like_button', ['post' => $post]);?>
                <span class="bothie-rat"><?=$post->score;?></span>
            </div>
        </div>
    <?php endif;?>
<?php $key++;
endforeach;?>
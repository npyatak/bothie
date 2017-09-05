<?php $key = 1;?>
<?php foreach ($posts as $post):?>
    <?php if($key % 4 == 1):?>
    <div class="item">
        <div class="bothie-vertical bothie-wrap">
            <div class="wrap">
                <div class="top bothie" style="background-image:url(<?=$post->frontImageUrl;?>)"></div>
                <div class="bottom bothie" style="background-image:url(<?=$post->backImageUrl;?>)"></div>
                <?=$this->render('_vote_like_button', ['post' => $post]);?>
                <span class="bothie-rat"><?=$post->score;?></span>
            </div>
        </div>
    </div>
    <?php elseif($key % 4 == 2):?>
    <div class="item w2">
        <div class="bothie-vertical-wrap">
            <div class="bothie-vertical bothie-wrap">
                <div class="wrap">
                    <div class="top bothie" style="background-image:url(<?=$post->frontImageUrl;?>)"></div>
                    <div class="bottom bothie" style="background-image:url(<?=$post->backImageUrl;?>)"></div>
                    <?=$this->render('_vote_like_button', ['post' => $post]);?>
                    <span class="bothie-rat"><?=$post->score;?></span>
                </div>
            </div>
        <?php if($key == count($posts)):?>
        </div>
    </div>
        <?php endif;?>
    <?php elseif($key % 4 == 3):?>
            <div class="bothie-vertical bothie-wrap">
                <div class="wrap">
                    <div class="top bothie" style="background-image:url(<?=$post->frontImageUrl;?>)"></div>
                    <div class="bottom bothie" style="background-image:url(<?=$post->backImageUrl;?>)"></div>
                    <?=$this->render('_vote_like_button', ['post' => $post]);?>
                    <span class="bothie-rat"><?=$post->score;?></span>
                </div>
            </div>
        </div>
    </div>
    <?php else:?>
    <div class="item text-right">
        <div class="bothie-vertical bothie-wrap">
            <div class="wrap">
                <div class="top bothie" style="background-image:url(<?=$post->frontImageUrl;?>)"></div>
                <div class="bottom bothie" style="background-image:url(<?=$post->backImageUrl;?>)"></div>
                <?=$this->render('_vote_like_button', ['post' => $post]);?>
                <span class="bothie-rat"><?=$post->score;?></span>
            </div>
        </div>
    </div>
    <?php endif;?>
<?php $key++;?>
<?php endforeach;?>
<?php
use common\models\Week;
?>

<div class="p-a_links-week">
    <?php foreach ($weeks as $week):?>
    <div>
        <?php switch ($week->status) {
            case Week::STATUS_ACTIVE;
                $class = 'active';
                break;
            case Week::STATUS_WAITING;
                $class = 'disabled';
                break;                          
            default:
                $class = '';
                break;
        }?>
        <a href="" class="<?=$class;?>"><?=$week->number;?> неделя <?=$week->name;?></a>
    </div>
    <?php endforeach;?>
</div>
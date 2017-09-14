<?php
use yii\helpers\Html;

$this->title = 'Авторизация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="site-login__inner">
        <?=$this->render('_login');?>
    </div>
</div>
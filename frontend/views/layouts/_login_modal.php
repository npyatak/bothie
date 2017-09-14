<?php 
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;

Yii::$app->assetManager->bundles = [
    'yii\bootstrap\BootstrapPluginAsset' => false,
    'yii\bootstrap\BootstrapAsset' => false,
];

yii\bootstrap\Modal::begin([
    'id' => 'modal-login',
    'size' => 'modal-md',
    'header' => null,
    'closeButton' => false,
]);
?>

<div id="modalContent">
    <?=$this->render('../site/_login');?>
</div>
<?php yii\bootstrap\Modal::end();?>
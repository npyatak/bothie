<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/font-awesome.min.css',
        'css/bootstrap.css',
        'css/owl.carousel.min.css',
        'css/core.css',
        'css/main.css',
        'css/animate.css',
    ];
    public $js = [
        'js/popper.min.js',
        //['https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js', 'integrity' => 'sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4', 'crossorigin' => 'anonymous'],
        'js/bootstrap.min.js',
        'js/owl.carousel.min.js',
        'js/imagesloaded.pkgb.js',
        'js/masonry.pkgd.js',
        'js/main.js',
        'js/wow.min.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
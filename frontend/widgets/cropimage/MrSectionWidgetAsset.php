<?php
/**
 * Created by PhpStorm.
 * @user: MackRias
 * @site: http://mackrais.com
 * @email: mackraiscms@gmail.com
 */

namespace frontend\widgets\cropimage;

use yii\web\AssetBundle;


class MrSectionWidgetAsset extends AssetBundle{

    public $sourcePath = '@frontend/widgets/cropimage/assets';

    public $depends = [
        'frontend\assets\AppAsset'
    ];

    public function init() {
        $this->css[] = YII_DEBUG ? 'css/MrSection.css' : 'css/MrSection.min.css';
        $this->css[] = YII_DEBUG ? 'css/jquery.guillotine.css' : 'css/jquery.guillotine.min.css';

        $this->js[] = YII_DEBUG ? 'js/jquery.guillotine.js' : 'js/jquery.guillotine.min.js';
        $this->js[] = YII_DEBUG ? 'js/mr.section.js' : 'js/mr.section.min.js';
    }
}

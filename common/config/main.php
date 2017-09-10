<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cacheBackend' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => Yii::getAlias('@backend') . '/runtime/cache'
        ],
        'cacheFrontend' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => Yii::getAlias('@frontend') . '/runtime/cache'
        ], 
    ],
];

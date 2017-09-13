<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
$baseUrl = str_replace('/frontend/web', '', (new \yii\web\Request)->getBaseUrl());

return [
    'id' => 'app-frontend',
    'language' => 'ru-RU',
    'sourceLanguage' => 'en-US',
    'name' => 'Короли Bothie',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'assetsAutoCompress'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'baseUrl' => $baseUrl,
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'assetManager' => [
            'bundles' => [
            ]
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'eauth' => [
            'class' => 'nodge\eauth\EAuth',
            'popup' => true, // Use the popup window instead of redirecting.
            'cache' => false, // Cache component name or false to disable cache. Defaults to 'cache' on production environments.
            'cacheExpire' => 0, // Cache lifetime. Defaults to 0 - means unlimited.
            'services' => [                
                'ig' => [
                    // register your app here: https://instagram.com/developer/register/
                    'class' => 'frontend\models\social\IgOAuth2Service',
                    //'class' => 'nodge\eauth\services\InstagramOAuth2Service',
                    'clientId' => '69af594a80984ee9ab1f3881681c68c0',
                    'clientSecret' => '058cbd92e0e04b83b45c8f18acd3070c',
                ],
                // 'fb' => [
                //     // register your app here: https://developers.facebook.com/apps/
                //     'class' => 'frontend\models\social\FbOAuth2Service',
                //     'clientId' => '122710335053583',
                //     'clientSecret' => '5fe0786168048de95a3a0a46acfdd433',
                // ],
                // 'vk' => [
                //     // register your app here: https://vk.com/editapp?act=create&site=1
                //     'class' => 'frontend\models\social\VkOAuth2Service',
                //     'clientId' => '6165041',
                //     'clientSecret' => 'pL5bLfr1JicZdCjLLtCX',
                // ],
            ],
        ],
        'i18n' => [
            'translations' => [
                'eauth' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@eauth/messages',
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                'rules.pdf' => 'site/rules-pdf',
                //'rules' => 'site/page?url=rules',
                //'personal-info-rules' => 'site/page',
                'post/<id:\d+>' => 'site/post',
                'post/<id:\d+>/image.jpg' => 'site/image',
                'how-to-win' => 'site/how-to-win',
                '<action:\w+>' => 'site/<action>',
                'page/<url>'=>'site/page',
            ],
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'logFile' => '@app/runtime/logs/eauth.log',
                    'categories' => ['nodge\eauth\*'],
                    'logVars' => [],
                ],
            ],
        ],
        'assetsAutoCompress' => [
            'class'             => '\skeeks\yii2\assetsAuto\AssetsAutoCompressComponent',
            'enabled'           => YII_ENV_DEV ? false : true,
            'jsCompress'        => YII_ENV_DEV ? false : true,
            'cssFileCompile'    => YII_ENV_DEV ? false : true,
            'jsFileCompile'     => YII_ENV_DEV ? false : true,
        ],
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    //'js' => ['/js/jquery-3.2.1.min.js'],
                ],
            ],
        ],
    ],
    'params' => $params,
];

<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'test' => [
            'class' => 'app\modules\test\Module',
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'sdfsdfdhhg',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['modules']['jid'] = [
        'class'=>'landrain\Module',
        'name'=>'接口调试系统',
        'password'=>'123456',
        'ipFilters'=>['*','::1'],
        'language' => 'en',
        'loginConfig'=>[
            'loginUrl' => '/sail/seller/login',
            'fieldMapping'=>[
                'account'=>'domain',
                'password'=>'password',
            ],
        ],
        'subOfClasses' => [], //需要继承的classes
        'dropdownList' => [
            "android下载" => "https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1547463466873&di=3e5a65b07a4dddf84fce5f421f0b64ca&imgtype=0&src=http%3A%2F%2Fy3.ifengimg.com%2Fnews_spider%2Fdci_2013%2F09%2Fb85234c4801f8b2d7771353867a7a0f8.jpg"
        ], //右上角下拉image
        'xhprofUrl' => 'http://192.168.1.254:8888/xhprof_html/index.php', //xhprofUrl链接
    ];

    $config['defaultRoute']  = 'jid';
    if(isset($_REQUEST['xhprof']) && $_REQUEST['xhprof'] == 1){
        xhprof_enable(XHPROF_FLAGS_CPU+XHPROF_FLAGS_MEMORY);
    }
}

return $config;

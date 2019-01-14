<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

$config['modules']['jid'] = [
    'class'=>'landrain\Module',
    'name'=>'接口调试系统',
    'password'=>'123456',
    'ipFilters'=>['*','::1'],
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

(new yii\web\Application($config))->run();

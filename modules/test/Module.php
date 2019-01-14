<?php

namespace app\modules\test;

/**
 * Class Module
 * @package app\modules\test
 * @jid-enable
 * @jid-name 模块名称
 * @jid-id 模块ID
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\test\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}

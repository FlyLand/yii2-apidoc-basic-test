<?php

namespace app\modules\test\controllers;

use yii\web\Controller;

/**
 * Class DefaultController
 * @package app\modules\test\controllers
 * @brief controller名称
 */
class DefaultController extends Controller
{
    /**
     * @brief 接口名称
     * @param string $name name your'name
     * @method GET
     * @detail 接口描述
     * @return array
     * @throws Null
     * @return string
     */
    public function actionIndex()
    {
        $name = \Yii::$app->request->get('name');
        echo json_encode([
            'message' => $name
        ]);
        exit();
    }
}

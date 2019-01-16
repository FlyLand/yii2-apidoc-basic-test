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
     * this is a test
     *
     * @brief 接口名称
     * @param string $name this is your test name (=name:defaultValue=)
     * @method GET
     * @detail 接口描述
     * @return array
     * @throws Null
     * @return string
*/
    public function actionIndex()
    {
        $name = \Yii::$app->request->get('name');
        if (in_array(YII_ENV, ['dev','test']) && isset($_REQUEST['xhprof']) && intval($_REQUEST['xhprof']) === 1) {
            $this->xhprof_test();
        }
        echo json_encode([
            'message' => $name
        ]);
        exit();
    }

    private function xhprof_test()
    {
        $xhprof_data = xhprof_disable();

        //得到统计数据之后，以下的工作就是为页面显示做准备。
        $xhprof_root = "@vendor/landrain/yii2-apidoc/src/components/";//这里填写的就是你的xhprof的路径

        include_once $xhprof_root . "xhprof_lib.php";
        include_once $xhprof_root . "xhprof_runs.php";

        $xhprof_runs = new \XHprofRuns_Default();
        $run_id      = $xhprof_runs->save_run($xhprof_data, "xhprof");//第二个参数在接下来的地方作为命名空间一样的概念来使用
        $xhprofUrl = \Yii::$app->modules['jid']['xhprofUrl'] ?? '';
        if (!empty($xhprofUrl) && isset(\Yii::$app->modules['jid']) && \Yii::$app->modules['jid']['xhprofUrl']) {
            header("location: $xhprofUrl?run=" . $run_id . "&source=xhprof");
            exit;
        }
    }
}

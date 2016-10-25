<?php
/**
 * @link http://www.yiiframework.com/
 *
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 *
 * @since 2.0
 */
class FrontendAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'frontend/css/index.css',
    ];
    public $js = [
     'frontend/js/index.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public static function addScript($view, $jsfile)
    {
        $view->registerJsFile($jsfile, [FrontendAsset::className(), 'depends' => "app\assets\FrontendAsset"],1);
    }
  //定义按需加载css方法，注意加载顺序在最后
   public static function addCss($view, $cssfile)
   {
      $view->registerCssFile($cssfile, [FrontendAsset::className(), 'depends' => "app\assets\FrontendAsset"]);
   }
}

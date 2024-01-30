<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;


class NewAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/',
        'css/site.css',
        'css/style.css',
        'css/materialdesignicons.min.css',
        'css/vendor.bundle.base.css',
         
        
        
    ];
    public $js = [

        'js/vendor.bundle.base.js',
        'js/scripts.js',
        'js/off-canvas.js',
        'js/hoverable-collapse.js',
        'js/misc.js',
        'js/settings.js',
        'js/todolist.js',
            "https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js",
    ];
    public $images= [
       'images/',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset'
    ];
}
?>
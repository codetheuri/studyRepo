<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class DashboardAsset extends AssetBundle

{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700',
        'css/nucleo-icons.css',
        'css/nucleo-svg.css',
        "https://fonts.googleapis.com/icon?family=Material+Icons+Round",


    ];
    public $js = [
        "https://kit.fontawesome.com/42d5adcbca.js",
        "https://api.nepcha.com/js/nepcha-analytics.js",
        'js/popper.min.js',
        'js/bootstrap.min.js',
        'js/boostrap.bundle.min.js',
    ];
    public $dist= [
        //'img/AdminLTELogo.png',
        'img/',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
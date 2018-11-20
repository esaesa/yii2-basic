<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
    ];
    public $depends = [
        // 'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
        'yii\web\YiiAsset',
        //'app\assets\PopperJsAsset', //Before bootstrap. No need if bootstrap bundle is used.
        'yii\bootstrap4\BootstrapPluginAsset',
        'app\assets\HolderJsAsset',//Used to generate inline thumbnails.

    ];
}

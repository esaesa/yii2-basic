<?php

namespace app\assets;

use yii\web\AssetBundle;

class PopperJsAsset extends AssetBundle
{
    public $sourcePath = '@bower/popper.js/dist';
    public $js = [
        'popper.min.js',
        'popper-utils.min.js'
    ];

}
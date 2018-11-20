<?php

namespace app\assets;

use yii\web\AssetBundle;

class HolderJsAsset extends AssetBundle
{
    public $sourcePath = '@bower/holderjs';
    public $js = [
        'holder.min.js'
    ];

}
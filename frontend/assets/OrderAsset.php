<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/14
 * Time: 16:16
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class OrderAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'style/base.css',
        'style/global.css',
        'style/header.css',
        'style/footer.css',
        'style/fillin.css',

    ];
    public $js = [
        'js/cart2.js',
    ];
    public $depends = [
        //JqueryAsset::className(),

        'yii\web\JqueryAsset',
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];


}
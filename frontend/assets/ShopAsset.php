<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/11
 * Time: 11:03
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class ShopAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'style/base.css',
        'style/global.css',
        'style/header.css',
        'style/footer.css',
        'style/index.css',
        'style/bottomnav.css',
    ];
    public $js = [
        'js/index.js',
        'js/header.js',
        'js/jquery-1.8.3.min.js'
    ];
    public $depends = [
        //JqueryAsset::className(),

        'yii\web\JqueryAsset',
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
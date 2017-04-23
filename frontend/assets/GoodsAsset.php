<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/12
 * Time: 9:19
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class GoodsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'style/base.css',
        'style/global.css',
        'style/header.css',
        'style/goods.css',
        'style/footer.css',
        'style/common.css',
        'style/bottomnav.css',
        'style/jqzoom.css'
    ];
    public $js = [
        'js/goods.js',
        'js/header.js',
        'js/jqzoom-core.js',
        'js/jquery-1.8.3.min.js'
    ];
    public $depends = [
        //JqueryAsset::className(),

        'yii\web\JqueryAsset',
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
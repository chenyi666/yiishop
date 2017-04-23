<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/12
 * Time: 17:01
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class CartAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'style/base.css',
        'style/global.css',
        'style/header.css',
        'style/footer.css',
        'style/cart.css',

    ];
    public $js = [
        'js/cart1.js',
    ];
    public $depends = [
        //JqueryAsset::className(),

        'yii\web\JqueryAsset',
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
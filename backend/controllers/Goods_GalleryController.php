<?php

namespace backend\controllers;

use backend\models\GoodsGallery;
use hongyukeji\qiniu\Qiniu;
use xj\uploadify\UploadAction;

class Goods_GalleryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionAdd($goods_id){
       /* //接受数据
        $goods_id=$_GET['goods_id'];*/
        //实例化表单模型
        $goods= new GoodsGallery();
        //展示相册添加页面
        return $this->render('add',['goods'=>$goods]);
    }
    public function actions() {
        return [
            's-upload' => [
                'class' => UploadAction::className(),
                'basePath' => '@webroot/upload/gallery',
                'baseUrl' => '@web/upload/gallery',
                'enableCsrf' => true, // default
                'postFieldName' => 'Filedata', // default
                //BEGIN METHOD
                /*    'format' => [$this, 'methodName'],*/
                //END METHOD
                //BEGIN CLOSURE BY-HASH
                'overwriteIfExist' => true,
                /*    'format' => function (UploadAction $action) {
                        $fileext = $action->uploadfile->getExtension();
                        $filename = sha1_file($action->uploadfile->tempName);
                        return "{$filename}.{$fileext}";
                    },*/
                //END CLOSURE BY-HASH
                //BEGIN CLOSURE BY TIME
                'format' => function (UploadAction $action) {
                    $fileext = $action->uploadfile->getExtension();
                    $filehash = sha1(uniqid() . time());
                    $p1 = substr($filehash, 0, 2);
                    $p2 = substr($filehash, 2, 2);
                    return "{$p1}/{$p2}/{$filehash}.{$fileext}";
                   
                },
                //END CLOSURE BY TIME
                'validateOptions' => [
                    'extensions' => ['jpg', 'png'],
                    'maxSize' => 1 * 1024 * 1024, //file size
                ],
                'beforeValidate' => function (UploadAction $action) {
                    //throw new Exception('test error');
                },
                'afterValidate' => function (UploadAction $action) {},
                'beforeSave' => function (UploadAction $action) {},
                'afterSave' => function (UploadAction $action) {
                    $action->output['fileUrl'] = $action->getWebUrl();
                    $file=$action->getFilename(); // "image/yyyymmddtimerand.jpg"
                    $action->getWebUrl(); //  "baseUrl + filename, /upload/image/yyyymmddtimerand.jpg"
                    $path= $action->getSavePath(); // "/var/www/htdocs/upload/image/yyyymmddtimerand.jpg"
                   /* $ak = '5mC-WESG9kQDU3hhA0IaLN97TWZNwdNdmwiDgcrE';
                    $sk = 'MLhNyMnKZ1dq1dLgkZo1hE2S5gzT7FiXziWmesNZ';
                    $domain = 'http://onk49e5lt.bkt.clouddn.com';
                    $bucket = 'yii-shop';
                    $qiniu = new Qiniu($ak, $sk,$domain, $bucket);
                    $url= $qiniu->getLink($file);
                    $action->output['fileUrl'] =$url;
                    $qiniu->uploadFile($path,$file);*/
                },
            ],
        ];
    }
}

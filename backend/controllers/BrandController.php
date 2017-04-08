<?php

namespace backend\controllers;

use backend\models\Brand;
use yii\data\Pagination;
use yii\web\Request;
use yii\web\UploadedFile;
use xj\uploadify\UploadAction;
use hongyukeji\qiniu\Qiniu;
class BrandController extends \yii\web\Controller
{
    public function actionIndex()
    {
        //获取总条数
        $total=Brand::find()->where(['>=','status',0])->count();
        //每页显示多少条
        $pagesize=3;
        //获取当前页
        $pager=new Pagination(
            ['totalCount'=>$total,
            'pageSize'=>$pagesize]
        );
        //设置sql参数
        $brands=Brand::find()->where(['>=','status',0])->limit($pager->limit)->offset($pager->offset)->all();
        //分配数据，显示页面
        return $this->render('index',['brands'=>$brands,'pager'=>$pager]);
    }
    public function actionAdd(){
        //实例化表单模型
        $model=new Brand();
        //判断请求方式
        $request=new Request();
        if($request->isPost){
            //接收数据
            $model->load($request->post());
            //实例化上传文件对象
            /*$model->logo_file=UploadedFile::getInstance($model,'logo_file');*/
        /*    $model->logo_file=UploadedFile::getInstance($model,'logo_file');*/
            //验证数据
            if($model->validate()){
                //判断是否有图片上传
               /* if($model->logo_file){
                    //处理图片路径
                  $fileName='upload/brand/'.uniqid().'.'.$model->logo_file->extension;
                 $model->logo_file->saveAs($fileName,false);
                $model->logo=$fileName;
                }*/
                //保存数据
                $model->save();
                //跳转到首页
                \Yii::$app->session->setFlash('success','添加成功');
                return $this->redirect(['brand/index']);
            }

        }
        //显示添加页面
        return $this->render('add',['model'=>$model]);
    }
    //编辑
    public function actionEdit($id){
        $model=Brand::findOne(['id'=>$id]);
        //判断请求方式
        $request=new Request();
        if($request->isPost){
            //接收数据
            $model->load($request->post());
            //实例化上传文件对象
            $model->logo_file=UploadedFile::getInstance($model,'logo_file');
            //验证数据
            if($model->validate()){
                //判断是否有图片上传
                if($model->logo_file){
                    //处理图片路径
                    $fileName='upload/brand/'.uniqid().'.'.$model->logo_file->extension;
                    $model->logo_file->saveAs($fileName,false);
                    $model->logo=$fileName;
                }
                //保存数据
                $model->save();
                //跳转到首页
                \Yii::$app->session->setFlash('success','修改成功');
                return $this->redirect(['brand/index']);
            }

        }
        //显示添加页面
        return $this->render('add',['model'=>$model]);
    }
    //删除
    public function actionDel($id){
        $model=Brand::findOne(['id'=>$id]);

        $model->status='-1';
        $model->save(false);
      /*  var_dump($model->status);
        exit;*/
        \Yii::$app->session->setFlash('success','删除成功');
        return $this->redirect(['brand/index']);
    }
    public function actions() {
        return [
            's-upload' => [
                'class' => UploadAction::className(),
                'basePath' => '@webroot/upload/brand',
                'baseUrl' => '@web/upload/brand',
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
                    /*$action->output['fileUrl'] = $action->getWebUrl();*/
                    $file=$action->getFilename(); // "image/yyyymmddtimerand.jpg"
                    $action->getWebUrl(); //  "baseUrl + filename, /upload/image/yyyymmddtimerand.jpg"
                   $path= $action->getSavePath(); // "/var/www/htdocs/upload/image/yyyymmddtimerand.jpg"
                    $ak = '5mC-WESG9kQDU3hhA0IaLN97TWZNwdNdmwiDgcrE';
                    $sk = 'MLhNyMnKZ1dq1dLgkZo1hE2S5gzT7FiXziWmesNZ';
                    $domain = 'http://onk49e5lt.bkt.clouddn.com';
                    $bucket = 'yii-shop';
                    $qiniu = new Qiniu($ak, $sk,$domain, $bucket);
                   $url= $qiniu->getLink($file);
                    $action->output['fileUrl'] =$url;
                    $qiniu->uploadFile($path,$file);
                },
            ],
        ];
    }
    //回收站
    public function actionRecycle(){
        $total=Brand::find()->where(['status'=>-1])->count();

        //每页显示多少条
        $pagesize=3;
        //获取当前页
        $pager=new Pagination(
            ['totalCount'=>$total,
                'pageSize'=>$pagesize]
        );
        //获取当前页
        $pager=new Pagination(
            ['totalCount'=>$total,
                'pageSize'=>$pagesize]
        );
        //设置sql参数
        $brands=Brand::find()->where(['status'=>-1])->limit($pager->limit)->offset($pager->offset)->all();
        //分配数据，显示页面
        return $this->render('recyle',['brands'=>$brands,'pager'=>$pager]);
    }
    public function actionTest(){
        $ak = '5mC-WESG9kQDU3hhA0IaLN97TWZNwdNdmwiDgcrE';
        $sk = 'MLhNyMnKZ1dq1dLgkZo1hE2S5gzT7FiXziWmesNZ';
        $domain = 'onk49e5lt.bkt.clouddn.com';
        $bucket = 'yii-shop';
        $qiniu = new Qiniu($ak, $sk,$domain, $bucket);
        $key = time();
        $qiniu->uploadFile('D:\www\yiishop\backend\web\upload\ad\75\ad75214bf59d98087fe4299dfc0e3f778ea5c1d3.jpg',$key);
        return $url = $qiniu->getLink($key);
    }
}

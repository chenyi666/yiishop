<?php

namespace backend\controllers;

use backend\models\Brand;
use backend\models\Goods;
use backend\models\GoodsCategory;
use backend\models\GoodsDayCount;
use backend\models\GoodsIntro;
use backend\models\Search;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\web\Request;
use yii\web\UploadedFile;

class GoodsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $query=Goods::find();
        //获取总条数

        $search=new Search();
        if ($search->load(\Yii::$app->request->get()) && $search->validate()){
            if($search->name){
                $query->andWhere(['like','name',$search->name]);
            }
            if ($search->sn){
                $query->andWhere(['like','sn',$search->sn]);
            }
           if($search->max_price){
                $query->andWhere(['<=','shop_price',$search->max_price]);
            }
            if($search->min_price){
                $query->andWhere(['<=','shop_price',$search->min_price]);
            }
        }
        $total=$query->andwhere(['>=','status',0])->count();
        //每页显示多少条
        $pagesize=3;
        //获取当前页
        $pager=new Pagination(
            ['totalCount'=>$total,
                'pageSize'=>$pagesize]
        );
        //设置sql参数
        $goods=$query->limit($pager->limit)->offset($pager->offset)->all();
        //分配数据，显示页面
        return $this->render('index',['goods'=>$goods,'pager'=>$pager,'search'=>$search]);
    }
    public function actionAdd(){
        //实例化表单模型
        $model=new Goods();
        $content=new GoodsIntro();
        //获取分类信息
        $cate=GoodsCategory::find()->asArray()->all();
        /*$cate_option=ArrayHelper::map($cate,'id','name');*/
        //将其转换为js字符串
        $first=['id'=>0,'parent_id'=>0,'name'=>'顶级分类'];
        $cate[]=$first;
        $cate=json_encode($cate);
        //获取品牌信息
        $brand=Brand::find()->all();
        $brand_option=ArrayHelper::map($brand,'id','name');
        //判断请求方式
        $request=new Request();
        if($request->isPost){
            //获取数据
            $model->load($request->post());
            $content->load($request->post());
            //实例化文件上传duix
            $model->logo_file=UploadedFile::getInstance($model,'logo_file');
            //验证
            if($model->validate()){
                //判断是否有图片上传
                if($model->logo_file){
                    //处理图片路径
                    $fileName='upload/goods/'.uniqid().'.'.$model->logo_file->extension;
                    $model->logo_file->saveAs($fileName,false);
                    $model->logo=$fileName;
                }
                $model->inputtime=time();
                //实例化库存
                $daycount=new GoodsDayCount();
                //判断当天的是否有商品
                if(($rs=GoodsDayCount::find()->where(['day'=>date("Ymd",$model->inputtime)])->count())>0){
                    //找到当前日期的数据
                    $day=GoodsDayCount::findOne(['day'=>date("Ymd",$model->inputtime)]);
                    $day->count+=1;
                    $day->save();
                    $model->sn=$day->day.str_pad($day->count,4,0,STR_PAD_LEFT);
                    $model->save();
                    //保存商品简介
                    $content->goods_id=$model->id;
                    $content->save();
                }else{
                $daycount->day=date('Ymd',$model->inputtime);
                    $daycount->count=1;
                    $daycount->save();
                    $model->sn=$daycount->day.str_pad($daycount->count,4,0,STR_PAD_LEFT);
                    $model->save();
                    //保存商品简介
                    $content->goods_id=$model->id;
                    $content->save();
                }

            }

            //添加完后，提示信息,跳转到相册添加页面
            \Yii::$app->session->setFlash('success','商品添加成功，请添加相册');
            return $this->redirect(["goods_-gallery/add?goods_id={$model->id}"]);

        }
        //分配数据，展示添加页面
        return $this->render('add',['model'=>$model,'content'=>$content,'cate'=>$cate,       'brand_option'=>$brand_option]);
    }
    public function actionDel($id){
        //根据传入id找到数据
        $good=Goods::findOne(['id'=>$id]);
        $good->status=0;
        $good->save(false);
        \Yii::$app->session->setFlash('success','删除成功');
        return $this->redirect(["goods/index"]);
    }
    public function actionEdit($id){
        //实例化表单模型
        $model=Goods::findOne(['id'=>$id]);
        $content=GoodsIntro::findOne(['goods_id'=>$id]);
        //获取分类信息
        $cate=GoodsCategory::find()->asArray()->all();
        /*$cate_option=ArrayHelper::map($cate,'id','name');*/
        //将其转换为js字符串
        $first=['id'=>0,'parent_id'=>0,'name'=>'顶级分类'];
        $cate[]=$first;
        $cate=json_encode($cate);
        //获取品牌信息
        $brand=Brand::find()->all();
        $brand_option=ArrayHelper::map($brand,'id','name');
        //判断请求方式
        $request=new Request();
        if($request->isPost){
            //获取数据
            $model->load($request->post());
            $content->load($request->post());
            //实例化文件上传duix
            $model->logo_file=UploadedFile::getInstance($model,'logo_file');
            //验证
            if($model->validate()){
                //判断是否有图片上传
                if($model->logo_file){
                    //处理图片路径
                    $fileName='upload/goods/'.uniqid().'.'.$model->logo_file->extension;
                    $model->logo_file->saveAs($fileName,false);
                    $model->logo=$fileName;
                }
                $model->inputtime=time();
                //实例化库存
                $daycount=new GoodsDayCount();
                //判断当天的是否有商品
                if(($rs=GoodsDayCount::find()->where(['day'=>date("Ymd",$model->inputtime)])->count())>0){
                    //找到当前日期的数据
                    $day=GoodsDayCount::findOne(['day'=>date("Ymd",$model->inputtime)]);
                    $day->count+=1;
                    $day->save();
                    $model->sn=$day->day.str_pad($day->count,4,0,STR_PAD_LEFT);
                    $model->save();
                    //保存商品简介
                    $content->goods_id=$model->id;
                    $content->save();
                }else{
                    $daycount->day=date('Ymd',$model->inputtime);
                    $daycount->count=1;
                    $daycount->save();
                    $model->sn=$daycount->day.str_pad($daycount->count,4,0,STR_PAD_LEFT);
                    $model->save();
                    //保存商品简介
                    $content->goods_id=$model->id;
                    $content->save();
                }

            }

            //添加完后，提示信息,跳转到相册添加页面
            \Yii::$app->session->setFlash('success','商品添加成功，请添加相册');
            return $this->redirect(['goods_-gallery/add','goods_id'=>$model->id]);

        }
        //分配数据，展示添加页面
        return $this->render('add',['model'=>$model,'content'=>$content,'cate'=>$cate,       'brand_option'=>$brand_option]);
    }
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
                'config' => [
                    "imageUrlPrefix"  => "http://www.baidu.com",//图片访问路径前缀
                    "imagePathFormat" => "/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}"          ,//上传保存路径
                "imageRoot" => \Yii::getAlias("@webroot"),
            ],
        ]
    ];
    }
}

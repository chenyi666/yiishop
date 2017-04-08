<?php

namespace backend\controllers;

use backend\models\GoodsCategory;
use yii\db\Exception;
use yii\web\Request;

class Goods_CategoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $goodscates=GoodsCategory::find()->orderBy('tree,parent_id')->all();

        return $this->render('index',['goodscates'=>$goodscates]);
    }
    public function actionAdd(){
        //实例化表单模型
        $model=new GoodsCategory();
        //获取所有分类数据
        $cate=GoodsCategory::find()->asArray()->all();
        //将其转换为js字符串
        $first=['id'=>0,'parent_id'=>0,'name'=>'顶级分类'];
        $cate[]=$first;
        $cate=json_encode($cate);
        //判断请求方式
        $request=new Request();
        if($request->isPost){
            //接收数据
            $model->load($request->post());
            //验证数据
            if($model->validate()){
                //保存数据
                if($model->parent_id == 0){
                    $model->makeRoot();//创建一级分类

                }else{
                    //创建非一级分类
                    //查找父分类
                    $parent_cate = GoodsCategory::findOne(['id'=>$model->parent_id]);
                    $model->prependTo($parent_cate);

                }
                \Yii::$app->session->setFlash('success','分类添加成功');
                return $this->redirect(['goods_-category/index']);
            }
        }
        //展示表单添加页面
        return $this->render('add',['model'=>$model,'cate'=>$cate]);
    }
    public function actionTest(){
       /* $countries = new GoodsCategory(['name' => '大家电']);
        $countries->makeRoot();
      /*  $russia = new GoodsCategory(['name' => '电脑']);
        $russia->prependTo($countries);*/
        /*$countries->save();*/
    }
    public function actionDel($id){
       //判断删除的分类是否有子类
        $num=GoodsCategory::find()->where(['parent_id'=>$id])->count();
        if($num>0){
            \Yii::$app->session->setFlash('danger','该分类下面有子类不能删除');
            return $this->redirect(['goods_-category/index']);
        }else{
            GoodsCategory::deleteAll(['id'=>$id]);
            return $this->redirect(['goods_-category/index']);
        }

    }
    public function actionEdit($id){
        $model=GoodsCategory::findOne(['id'=>$id]);  //获取所有分类数据
        $cate=GoodsCategory::find()->asArray()->all();
        //将其转换为js字符串
        $first=['id'=>0,'parent_id'=>0,'name'=>'顶级分类'];
        $cate[]=$first;
        $cate=json_encode($cate);
        //判断请求方式
        $request=new Request();
        if($request->isPost){
            //接收数据
            $model->load($request->post());
            //验证数据
            if($model->validate()){
                try{
                    //保存数据
                    if($model->parent_id == 0){
                        $model->makeRoot();//创建一级分类

                    }else{
                        //创建非一级分类
                        //查找父分类
                        $parent_cate = GoodsCategory::findOne(['id'=>$model->parent_id]);
                        $model->prependTo($parent_cate);

                        \Yii::$app->session->setFlash('success','分类添加成功');
                        return $this->redirect(['goods_-category/index']);
                    }
                }catch (Exception $e){

                    $model->addError('parent_id',$e->getMessage());
                }
            }
        }
        //展示表单添加页面
        return $this->render('add',['model'=>$model,'cate'=>$cate]);
    }
}

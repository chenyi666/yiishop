<?php

namespace backend\controllers;

use backend\models\Menu;
use yii\helpers\ArrayHelper;

class MenuController extends \yii\web\Controller
{
    public function actionIndex()
    {
        //获取所有菜单，分配数据，展示视图
        $models=Menu::find()->orderBy('id')->orderBy('parent_id')->all();
        return $this->render('index',['models'=>$models]);
    }
    public function actionAdd(){
        //实例化表单模型
        $model=new Menu();
        $cate=ArrayHelper::map(Menu::find()->asArray()->all(),'id','name');
        //获取分类信息
        $option=ArrayHelper::merge(['0'=>'顶级分类'],$cate);
        //接收数据，验证数据
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            //保存数据
            $model->save();
            //提示信息，跳转到首页
            \Yii::$app->session->setFlash('success','菜单添加成功');
            return $this->redirect(['menu/index']);
        }
        //展示视图
        return $this->render('add',['model'=>$model,'option'=>$option]);
    }
    public function actionEdit($id){
        //实例化表单模型
        $model=Menu::findOne(['id'=>$id]);
        $cate=ArrayHelper::map(Menu::find()->asArray()->all(),'id','name');
/*        $model->parent_id=$model->id;*/
        //获取分类信息
        $option=ArrayHelper::merge(['0'=>'顶级分类'],$cate);
        //接收数据，验证数据
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            //保存数据
            $model->save();
            //提示信息，跳转到首页
            \Yii::$app->session->setFlash('success','菜单修改成功');
            return $this->redirect(['menu/index']);
        }
        //展示视图
        return $this->render('add',['model'=>$model,'option'=>$option]);
    }
    public function actionDel($id){
        Menu::deleteAll(['id'=>$id]);
        \Yii::$app->session->setFlash('success','菜单删除成功');
        return $this->redirect(['menu/index']);
    }
}

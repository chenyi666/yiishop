<?php

namespace backend\controllers;

use backend\models\Article;
use backend\models\ArticleCategory;
use yii\data\Pagination;
use yii\web\Request;

class Article_CategoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $query=ArticleCategory::find();
        //总条数
        $total=$query->count();
        //每页显示多少条
        $pagesize=3;
        $pager=new Pagination(
            [
                'pageSize'=>$pagesize,
                'totalCount'=>$total
            ]
        );
        //获取数据
        $article_cates=$query->limit($pager->limit)->offset($pager->offset)->all();
        //分配数据
        return $this->render('index',['pager'=>$pager,'article_cates'=>$article_cates]);
    }
    public function actionAdd(){
        //实例化表单模型
        $model=new ArticleCategory();
        //判断请求方式
        $request=new Request();
        if($request->isPost){
            //接收数据
            $model->load($request->post());
            //验证
            if($model->validate()){
                //提示信息，保存数据，跳转到首页

                    \Yii::$app->session->setFlash('success','添加分类成功');
                    $model->save();
                    return $this->redirect(['article_-category/index']);
            }
        }
        //展示添加页面
        return $this->render('add',['model'=>$model]);
    }
    public function actionEdit($id){
        $model=ArticleCategory::findOne(['id'=>$id]);
        //判断请求方式
        $request=new Request();
        if($request->isPost){
            //接收数据
            $model->load($request->post());
            //验证
            if($model->validate()){
                //提示信息，保存数据，跳转到首页
                \Yii::$app->session->setFlash('success','修改分类成功');
                $model->save();
                return $this->redirect(['article_-category/index']);
            }
        }
        //展示添加页面
        return $this->render('add',['model'=>$model]);
    }
    public function actionDel($id){
        if(!Article::find()->where(['article_category_id'=>$id])->count()){
            ArticleCategory::deleteAll(['id'=>$id]);
            \Yii::$app->session->setFlash('success','删除成功');
            return $this->redirect(['article_-category/index']);
        }else{
            \Yii::$app->session->setFlash('danger','该分类下面有文章，不能删除');
            return $this->redirect(['article_-category/index']);
        }

    }
}

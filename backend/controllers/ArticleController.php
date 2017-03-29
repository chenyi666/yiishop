<?php

namespace backend\controllers;

use backend\models\Article;
use backend\models\ArticleCategory;
use backend\models\ArticleDetail;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\web\Request;

class ArticleController extends \yii\web\Controller
{
    public function actionIndex()
    {

        $query=Article::find();
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
        $articles=$query->limit($pager->limit)->offset($pager->offset)->all();
        //分配数据展示页面
        return $this->render('index',['articles'=>$articles,'pager'=>$pager]);
    }
    public function actionAdd(){
        //实例化表单模型
        $model=new Article();
        //获取分类信息
        $cates=ArticleCategory::find()->all();
        $cates_option=ArrayHelper::map($cates,'id','name');
        //判断请求方式
        $request=new Request();
        if ($request->isPost){
            //获取数据
            $model->load($request->post());
            //验证
            if($model->validate()){
                $model->inputtime=time();
                $model->save();
                //获取保存ID
                $id=\Yii::$app->db->getLastInsertID();
                //实例化文章内容表单
                $article_detail=new ArticleDetail();
                $article_detail->content=$model->content;
                $article_detail->article_id=$id;
                $article_detail->save();
                //提示，跳转
                \Yii::$app->session->setFlash('success','添加成功');
                return $this->redirect(['article/index']);
            }
        }
        //展示表单添加页面
        return $this->render('add',['model'=>$model,'cates_option'=>$cates_option]);

    }
    public function actionEdit($id){
        //实例化表单模型
        $model=Article::findOne(['id'=>$id]);
        $obj=ArticleDetail::findOne(['id'=>$id]);
        //获取内容
        $content=ArticleDetail::findOne($id)->content;
        $model->content=$content;
        //获取分类信息
        $cates=ArticleCategory::find()->all();
        $cates_option=ArrayHelper::map($cates,'id','name');
        //判断请求方式
        $request=new Request();
        if ($request->isPost){
            //获取数据
            $model->load($request->post());
            //验证
            if($model->validate()){
                $model->inputtime=time();
                $model->save();
                //实例化文章内容表单
                $obj->content=$model->content;
                $obj->article_id=$id;
                $obj->save();
                //提示，跳转
                \Yii::$app->session->setFlash('success','修改成功');
                return $this->redirect(['article/index']);
            }
        }
        //展示表单添加页面
        return $this->render('add',['model'=>$model,'cates_option'=>$cates_option]);

    }
    //删除
    public function actionDel($id){
        Article::deleteAll(['id'=>$id]);
        ArticleDetail::deleteAll(['article_id'=>$id]);
        //提示，跳转
        \Yii::$app->session->setFlash('success','删除成功');
        return $this->redirect(['article/index']);

    }
}

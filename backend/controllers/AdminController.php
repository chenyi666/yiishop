<?php

namespace backend\controllers;

use backend\accessfilter\AccessFilter;
use backend\models\Admin;
use backend\models\LoginForm;
use yii\captcha\Captcha;
use yii\captcha\CaptchaAction;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Request;

class AdminController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $query=Admin::find();
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
        $admins=$query->limit($pager->limit)->offset($pager->offset)->all();
        return $this->render('index',['admins'=>$admins,'pager'=>$pager]);
    }
    public function actionAdd(){
        //实例化表单模型
        $model=new Admin();
        //判断请求方式
        $request=new Request();
        if($request->isPost){
            $model->load($request->post());
            //验证
            if($model->validate()){
                //给密码加盐加密
                $model->password=\Yii::$app->security->generatePasswordHash($model->password);
                //注册时间
                $model->addtime=time();
                //设置Auth_key
                $model->auth_key=\Yii::$app->security->generateRandomString();
                //第一次设置最后登录ip为注册时的ip
                $model->last_login_ip=$_SERVER['REMOTE_ADDR'];
                //实例化组件
                $authManager=\Yii::$app->authManager;
           /*     var_dump($model->roles);
                exit;*/
                $res=$model->save(false);
                //关联角色
                if($model->roles){
                    foreach ($model->roles as $role){
                        $role=$authManager->getRole($role);
                     $authManager->assign($role,$model->id);
                    }
                }

               if($res){
                   //注册后自动登录
                   \Yii::$app->user->login($model);
                   \Yii::$app->session->setFlash('success','注册成功');
                   return $this->redirect(['admin/index']);
               }
            }
        }
        //展示添加页面
        return $this->render('add',['model'=>$model]);
    }
    public function actionLogin(){
        //实例化表单模型
        $model=new LoginForm();
     //判断请求方式
        $request=new Request();
        if($request->isPost){
            $model->load($request->post());
            //验证
            if($model->login()){
                //验证通过
                \Yii::$app->session->setFlash('success','登录成功');
                //跳转到页面
                return $this->redirect(['admin/index']);
            }else{
                //验证失败
                \Yii::$app->session->setFlash('danger','用户名或密码错误');
                return $this->refresh();
            }
        }
        //展示登录页面
        return $this->render('login',['model'=>$model]);
    }
    public function actionLogout(){
        \Yii::$app->user->logout();
        \Yii::$app->session->setFlash('success','注销成功');
        return $this->redirect(['admin/login']);
    }
    public function actionEdit($id)
    {
        //实例化表单模型
        $model = Admin::findOne(['id' => $id]);
        //实例化RBAC组件
        $authmanager = \Yii::$app->authManager;
        //获取该用户拥有的角色
        $role = $authmanager->getRolesByUser($id);
        $model->roles = ArrayHelper::map($role, 'name', 'name');
        //判断请求方式
        $request = new Request();
        if ($request->isPost) {
            $model->load($request->post());
            //验证
            if ($model->validate()) {
                //给密码加盐加密
                $model->password = \Yii::$app->security->generatePasswordHash($model->password);
                // $model->repassword=\Yii::$app->security->generatePasswordHash($model->repassword);
                //注册时间
                $model->addtime = time();
                //第一次设置最后登录ip为注册时的ip
                $model->last_login_ip = $_SERVER['REMOTE_ADDR'];
                $res = $model->save(false);
                //删除该用户的所有角色
                $authmanager->revokeAll($id);
                if ($res) {
                    //关联角色
                    if ($model->roles) {
                        foreach ($model->roles as $role) {
                            $role = $authmanager->getRole($role);
                            $authmanager->assign($role, $model->id);
                        }
                        \Yii::$app->session->setFlash('success', '注册成功');
                        return $this->redirect(['admin/index']);
                    }
                }
            }

        }
        //展示添加页面
        return $this->render('add', ['model' => $model]);
    }
    public function actionDel($id){
        Admin::deleteAll(['id'=>$id]);
        //实例化RBAC组件
        $authmanager = \Yii::$app->authManager;
        //删除该用户和角色的关联
        $authmanager->revokeAll($id);
        \Yii::$app->session->setFlash('success', '删除成功');
        return $this->redirect(['admin/index']);
    }
    public function behaviors()
    {
        return [
            'AccessFilter'=>['class'=>AccessFilter::className(),
            'only'=>['add','del','edit','index'],
                ]
        ];
    }
/*    public function action(){
        return [
            'captcha'=>[
                'class'=>CaptchaAction::className(),
            ]
        ];
    }*/

}

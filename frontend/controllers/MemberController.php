<?php

namespace frontend\controllers;

use frontend\models\Address;
use frontend\models\LoginForm;
use frontend\models\Member;

use Flc\Alidayu\Client;
use Flc\Alidayu\App;
use Flc\Alidayu\Requests\AlibabaAliqinFcSmsNumSend;
use Flc\Alidayu\Requests\IRequest;
class MemberController extends \yii\web\Controller
{
    public $layout='login';
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionAdd(){
        //实例化表单模型
        $model=new Member();
        //接收数据，验证数据
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
        //接收Ajax数据
            $tel=\Yii::$app->request->post('tel');
            //设置Auth_key
            $model->auth_key=\Yii::$app->security->generateRandomString();
            //给密码加密
            $model->password=\Yii::$app->security->generatePasswordHash($model->password);
            //保存数据，登录跳转到首页
            if($model->save(false)){
                \Yii::$app->user->login($model);
                \Yii::$app->session->setFlash('success','注册成功');
                return $this->redirect(['member/index']);
            }
        }
        //展示页面
        return $this->render('add',['model'=>$model]);
    }
    //发送短信验证码
    public function actionSendMessage(){
        //接收ajax数据，保存到session中
        $tel=\Yii::$app->request->post('tel');
        //生成验证码
        $code=rand(1000,9999);
        \Yii::$app->session->set('tel_'.$tel,$code);
        //实例化
        $model=new Member();
        $model->sendCode($tel,$code);
    }
    public function actionLogin(){
        //实例化表单模型
        $model=new LoginForm();
        //接收数据，验证数据
        if($model->load(\Yii::$app->request->post())){
            if($model->login()){
                //提示信息，跳转到首页
                \Yii::$app->session->setFlash('success','登录成功');
                return $this->redirect(['member/index']);
            }
        }
        //展示登录页面
        return $this->render('login',['model'=>$model]);
    }
    public function actionTest(){

// 配置信息
        $config = [
            'app_key'    => '23746735',
            'app_secret' => '6e55e8b4e2dc0525c581e90016d581d0',
            // 'sandbox'    => true,  // 是否为沙箱环境，默认false
        ];


// 使用方法一
        $client = new Client(new App($config));
        $req    = new AlibabaAliqinFcSmsNumSend;

        $req->setRecNum('18215573033')
            ->setSmsParam([
                'code' => rand(100000, 999999),
                'name'=>'陈叔叔'
            ])
            ->setSmsFreeSignName('陈叔叔')
            ->setSmsTemplateCode('SMS_60865108');

        $resp = $client->execute($req);
        var_dump($resp);
    }
    /*
     * 地址管理
     */
    public function actionAddress()
    {
        $this->layout = 'member';
        $model = new Address();
        return $this->render('address',['model'=>$model]);
    }
}

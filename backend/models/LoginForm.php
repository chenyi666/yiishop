<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/2
 * Time: 13:57
 */

namespace backend\models;




use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;
/*    public $code;*/
    public $rememberMe = true;
    public function rules()
    {
        return [
            [['username','password'],'required'],
            ['rememberMe','boolean'],
   /*         ['code','captcha']*/
        ];
    }
    public function attributeLabels()
    {
        return [
            'username'=>'用户名',
            'password'=>'密码',
            /*'code'=>'验证码',*/
            'rememberMe'=>'一周内自动登录'
        ];
    }
    public function login(){
        //表单验证通过
      /*  var_dump($this->password);
        exit;*/
        if($this->validate()){
            //根据用户名查找用户
            $admin1=Admin::findOne(['username'=>$this->username]);
            $admin2=Admin::findOne(['email'=>$this->username]);
            if($admin1){
                $admin=$admin1;
            }
            if($admin2){
                $admin=$admin2;
            }

       /*  var_dump($this->name);
                var_dump($admin);
                echo 1;
                exit;*/
            //用户名存在
            if($admin){
               /* var_dump($admin);
                exit;*/
                //验证密码
                if( \Yii::$app->security->validatePassword($this->password,$admin->password)){
                    //登录成功保存到session中
                    \Yii::$app->user->login($admin,$this->rememberMe?3600*24*7:0);
                    $admin->last_login_time=time();
                    $admin->last_login_ip=$_SERVER['REMOTE_ADDR'];
                    $admin->save(false);
                    return true;
                }else{
                    $this->addError('password','密码错误');
                }
            }else{
                $this->addError('username','用户名不存在');
            }
        }
        //表单验证未通过
        return false;
    }

}
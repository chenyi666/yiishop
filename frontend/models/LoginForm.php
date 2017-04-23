<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/9
 * Time: 14:04
 */

namespace frontend\models;


use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe=true;
    public $captcha;
    public function rules()
    {
        return [
          [['username','password'],'required'],
            [['rememberMe'],'boolean'],
            ['captcha','captcha']
        ];
    }
    public function attributeLabels()
    {
        return [
            'username'=>'用户名',
            'password'=>'密码',
            'captcha'=>'验证码',
            'rememberMe'=>'一周内不用登录'
        ];
    }
    public function login(){
            //根据用户名查找用户信息
        if($this->validate()) {
            $member = Member::findOne(['username' => $this->username]);
            //用户名验证通过，验证密码
            if ($member) {
                if (\Yii::$app->security->validatePassword($this->password, $member->password)) {
                    //保存用户到session中
                    \Yii::$app->user->login($member, $this->rememberMe ? 3600 * 24 * 7 : 0);
                    $member->last_login_time = time();
                    $member->last_login_ip = ip2long($_SERVER['REMOTE_ADDR']);
                    $member->save(false);
                    return true;
                } else {
                    $this->addError('password', '密码错误');
                    return false;
                }
            } else {
                $this->addError('username', '用户名不存在');
                return false;
            }
        }
    }
}
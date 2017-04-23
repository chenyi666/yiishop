<?php

namespace frontend\models;

use Yii;
use yii\web\IdentityInterface;
use Flc\Alidayu\Client;
use Flc\Alidayu\App;
use Flc\Alidayu\Requests\AlibabaAliqinFcSmsNumSend;
use Flc\Alidayu\Requests\IRequest;


/**
 * This is the model class for table "member".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $tel
 * @property string $auth_key
 * @property integer $status
 * @property integer $addtime
 * @property integer $last_login_time
 * @property integer $last_login_ip
 */
class Member extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $repassword;//确认密码
    public $code;//短信验证码
    public $captcha;//验证码
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'email', 'tel',], 'required'],
            [['username', 'password', 'email'], 'string', 'max' => 255],
            [['tel'], 'string', 'max' => 11],
            ['repassword','compare','compareAttribute'=>'password','message'=>'两次输入的密码不一致'],
            [['username'], 'unique'],
            [['email'], 'unique'],
            ['email','email'],
            ['code','validateCode'],
        ];
    }
    public function validateCode($attributeNames = null, $clearErrors = true)
    {
        //根据电话号码从session获取短信验证码
        $code = Yii::$app->session->get('tel_'.$this->tel);
        //和表单提交的短信验证码对比
        if($code != $this->code){
            $this->addError('code','短信验证码不正确');
        }
    }
        //通过阿里大于发送验证码
    public function sendCode($tel,$code){
        // 配置信息
        $config = [
            'app_key'    => '23746735',
            'app_secret' => '6e55e8b4e2dc0525c581e90016d581d0',
            // 'sandbox'    => true,  // 是否为沙箱环境，默认false
        ];


// 使用方法一
        $client = new Client(new App($config));
        $req    = new AlibabaAliqinFcSmsNumSend;

        $req->setRecNum($tel)
            ->setSmsParam([
                'code' => $code,
                'name'=>$tel
            ])
            ->setSmsFreeSignName('陈叔叔')
            ->setSmsTemplateCode('SMS_60865108');

        $resp = $client->execute($req);

    }

    /*
     * 用户和地址的关系  1对多
     */
    public function getAddresses(){
        return $this->hasMany(Address::className(),['member_id'=>'id']);
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名：',
            'password' => '密码：',
            'email' => '邮箱：',
            'tel' => '电话：',
            'auth_key' => 'Auth Key',
            'repassword'=>'确认密码:',
            'code'=>'短信验证码',
            'captcha'=>'验证码',
            'status' => '状态:-1删除,0禁用，1正常',
            'addtime' => '注册时间',
            'last_login_time' => '最后登录时间',
            'last_login_ip' => '最后登录IP',
        ];
    }

    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return self::findOne(['id'=>$id]);
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key==$authKey;
    }

}

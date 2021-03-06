<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "admin".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $token
 * @property string $token_create_time
 * @property integer $addtime
 * @property integer $last_login_time
 * @property string $last_login_ip
 */
class Admin extends \yii\db\ActiveRecord implements IdentityInterface
{
        public $repassword;
        public $code;
        public $roles;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'email','repassword'], 'required'],
            [['username'], 'unique'],
            //'depth', 'compare', 'compareValue' => 2, 'operator' => '>=
            ['repassword','compare','compareAttribute'=>'password','message'=>'两次输入的密码不一致'],
            [['email'], 'unique'],
            [['email'],'email'],
            [['roles'],'safe']

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'password' => '密码',
            'email' => '邮箱',
            'token' => '自动登录令牌',
            'token_create_time' => '令牌创建时间',
            'addtime' => '注册时间',
            'last_login_time' => '最后登录时间',
            'last_login_ip' => '最后登录IP',
            'repassword'=>'确认密码'
        ];
    }
    //获取所有职位信息
    public static function getRoles(){
        //实例化RBAC组件
        $authManager=\Yii::$app->authManager;
        //获取所有角色
        $roles=$authManager->getRoles();
        return ArrayHelper::map($roles,'name','name');
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
        return $this->auth_key == $authKey;
    }
    /*
     * 通过方法拼装出
     *    [
           'label' => '商品管理',
           'items' => [
               ['label' => '商品列表', 'url' => ['goods/index']],
               ['label' => '添加商品', 'url' => ['goods/add']],
           ],
       ],
     */
    public function getItems(){
        //找到parent_id为0的放在label上；
        $labels=Menu::find()->where(['parent_id'=>0])->all();
        $menuItems=[];
        /*var_dump($labels);*/
        foreach ($labels as $label){
            $items=[];
            //判断该用户是否有权限

            foreach ($label->child as $child){
                if(Yii::$app->user->can($child->url)){
                    $items[]=['label'=>$child->name,'url'=>["{$child->url}"]];
                }
            }
            if(!empty($items)){
                $menuItems[]=[
                    'label' => $label->name,
                    //找出$lable->name，下面的分类放在 items=[]中
                    'items' => $items
                ];
            }
        }
        return $menuItems;
    }

}

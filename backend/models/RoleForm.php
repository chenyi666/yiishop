<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/5
 * Time: 13:46
 */

namespace backend\models;


use yii\base\Model;
use yii\helpers\ArrayHelper;

class RoleForm extends Model
{
    public $name;
    public $description;
    public $permissons;
    const  SCENARIO_ADD='add';
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        return ArrayHelper::merge($scenarios,[
            self::SCENARIO_ADD => ['name','description','permissions'],
        ]);
    }
    //定义验证规则
    public function rules()
    {
        return [
            [['name','description'],'required'],
            ['name','validateName','on'=>'add'],
            ['permissons','safe']
        ];
    }
    public function attributeLabels()
    {
        return [
          'name'=>'角色名',
            'description'=>'描述',
            'permissons'=>'权限',
        ];
    }
    public static function getPermission(){
        //实例化RBAC组件
        $authManager=\Yii::$app->authManager;
        //获取所有权限
       $permisson=$authManager->getPermissions();
        return ArrayHelper::map($permisson,'name','description');
    }

    //自定义验证规则角色名不能重复
    public function validateName($attribute){
        //实例化RBAC组件
        $authManager=\Yii::$app->authManager;
        if($authManager->getRole($attribute)){
            return $this->addError('角色名不能重复');
        }
    }

}
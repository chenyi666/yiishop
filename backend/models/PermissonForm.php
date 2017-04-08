<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/5
 * Time: 11:37
 */

namespace backend\models;


use yii\base\Model;

class PermissonForm extends Model
{
    public $name;//权限名
    public $description;//权限描述
    public function rules()
    {
        return [
            [['name','description'],'required'],
            ['name','validatePermissonName'],
        ];
    }
    public function attributeLabels()
    {
        return [
           'name'=>'权限名（路由）',
            'description'=>'描述'
        ];
    }
    //自定义规则验证权限名不能重复
    public function validatePermissonName($attribute)
    {
            //实例化组件
        $authManager=\Yii::$app->authManager;
        //通过模型属性值找到该权限
      $permisson=$authManager->getPermission($attribute);
        if($permisson){
            return $this->addError('该权限已存在');
        }
    }

}
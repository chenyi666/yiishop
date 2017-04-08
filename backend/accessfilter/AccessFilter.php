<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/8
 * Time: 9:35
 */
namespace backend\accessfilter;
class AccessFilter extends \yii\base\ActionFilter
{
    public function beforeAction($action)
    {
        //判断当前用户是否有权限
        \Yii::$app->user->can($action->uniqueId);
        //如果该用户没有登录跳转到登录界面
        if(\Yii::$app->user->isGuest){
            return $action->controller->redirect(\Yii::$app->user->loginUrl);
        }
        //抛出禁止访问的异常
        throw new \yii\web\HttpException(403,'您没有权限访问');
        return false;
        return parent::beforeAction($action);
    }
}
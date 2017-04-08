<?php

namespace backend\controllers;

use backend\models\PermissonForm;
use backend\models\RoleForm;
use yii\base\Exception;
use yii\base\InvalidParamException;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;

class RbacController extends \yii\web\Controller
{
    public function actionIndex()
    { //实例化RBAC组件
        $authManager=\Yii::$app->authManager;
        //获取所有权限
        $permissons=$authManager->getPermissions();
        //分配数据，展示列表视图
        return $this->render('index',['permissons'=>$permissons]);
    }
    public function actionAddPermisson(){
        //实例化表单模型
        $model=new PermissonForm();
        //接收数据，并验证
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            //实例化RBAC组件
            $authManager=\Yii::$app->authManager;
            //创建权限
            $permisson=$authManager->createPermission($model->name);
            $permisson->description=$model->description;
            //将权限保存到数据表
            if($authManager->add($permisson)){
                //提示成功信息，跳转到权限列表展示页面
                \Yii::$app->session->setFlash('success','权限添加成功');
                return $this->redirect(['rbac/index']);
            }
        }
        //展示添加页面视图
        return $this->render('addPermisson',['model'=>$model]);
    }
    //删除权限
    public function actionDelPermisson($name){
        //实例化RBAC组件
        $authManager=\Yii::$app->authManager;
        //获取要删除的权限
        $permisson=$authManager->getPermission($name);
        //删除权限
        $authManager->remove($permisson);
        //提示信息，跳转到首页
        \Yii::$app->session->setFlash('success','权限删除成功');
        return $this->redirect(['rbac/index']);
    }
    //添加角色
    public function actionAddRole(){
        //实例化表单模型
        $model=new RoleForm();
        //置顶场景
        $model->scenario=RoleForm::SCENARIO_ADD;
        //接收数据验证数据
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            //实例化RBAC组件
            $authManager=\Yii::$app->authManager;
            //创建角色
            $role=$authManager->createRole($model->name);
            $role->description=$model->description;
            //讲角色添加到数据表中
            $authManager->add($role);
            //给角色赋予权限
            if($model->permissons){
                foreach ($model->permissons as $permisson){
                    //获取权限
                    $permisson=$authManager->getPermission($permisson);
                    //给角色关联权限
                    $authManager->addChild($role,$permisson);
                }
            }

            //提示信息，跳转到角色列表
            //提示成功信息，跳转到权限列表展示页面
            \Yii::$app->session->setFlash('success','角色添加成功');
            return $this->redirect(['rbac/role-index']);
        }
        //展示添加页面
        return $this->render('addRole',['model'=>$model]);
    }
    //角色列表展示
    public function actionRoleIndex(){
        //实例化RBAC组件
        $authManager=\Yii::$app->authManager;
        //获取所有角色信息
        $roles=$authManager->getRoles();
        //分配数据，展示页面
        return $this->render('roleIndex',['roles'=>$roles]);
    }
    //修改角色
    public function actionEditRole($name){
        //实例化表单模型
        $model=new RoleForm();
        //实例化RBAC组件
        $authManager=\Yii::$app->authManager;
        //给表单模型属性赋值
        $model->name=$name;
        //获取该角色
        $role=$authManager->getRole($name);
        $model->description=$role->description;
        //找到该角色拥有的权限
        $permisson=$authManager->getPermissionsByRole($name);
        $model->permissons=array_keys($permisson);
        //接收数据验证数据
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $role->name=$model->name;
            $role->description=$model->description;
            //将角色更新到数据表中
            $authManager->update($role->name,$role);
      //清除该角色的所有权限
            $authManager->removeChildren($role);
            //给角色赋予权限
            if($model->permissons){
                foreach ($model->permissons as $permisson){
                    //获取权限
                    $permisson=$authManager->getPermission($permisson);
                    //给角色关联权限
                   try{
                       $authManager->addChild($role,$permisson);
                   }catch (Exception $e){
                       throw new BadRequestHttpException('不能修改角色名');
                   };
                }
            }

            //提示信息，跳转到角色列表
            //提示成功信息，跳转到权限列表展示页面
            \Yii::$app->session->setFlash('success','角色修改成功');
            return $this->redirect(['rbac/role-index']);
        }
        //展示添加页面
        return $this->render('addRole',['model'=>$model]);
    }
    //删除角色
    public function actionDelRole($name){
        //实例化RBAC组件
        $authManager=\Yii::$app->authManager;
        //找到该角色
        $role=$authManager->getRole($name);
        //删除角色
        $authManager->remove($role);
        \Yii::$app->session->setFlash('success','角色删除成功');
        return $this->redirect(['rbac/role-index']);
    }
}

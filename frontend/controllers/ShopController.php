<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/11
 * Time: 10:24
 */

namespace frontend\controllers;
use backend\models\Goods;
use backend\models\GoodsCategory;
use frontend\models\Cart;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\Cookie;

class ShopController extends Controller
{
    public $enableCsrfValidation = false;
    public $layout='index';
    //商城首页
    public function actionIndex(){

        //分配数据，展示首页
        return $this->render('index');
    }
    public function actionGoods(){
        //获取所有商品信息
        $goods=Goods::find()->all();
        //展示页面
        return $this->render('goods',['goods'=>$goods]);
    }

    public function actionGood($id){
        $this->layout='good';
        //查询当前商品信息
        $good=Goods::findOne(['id'=>$id]);
        return $this->render('good',['good'=>$good]);
    }
    public function actionNotice(){
        //获取商品Id和数量
        $goods_id=$_POST['goods_id'];
        $num=$_POST['amount'];
        if(\Yii::$app->user->isGuest){
            //将购物车的数据取出
            $cookies = \Yii::$app->request->cookies;
            $cookie = $cookies->get('cart');
            if($cookie == null){//购物车cookie不存在
                $cart = [];
            }else{//购物车cookie存在
                $cart = unserialize($cookie->value);
            }
            //将商品id和数量保存到cookie  //array_key_exists()检查数组中是否有给定键名
            //if(isset($cart[$goods_id]))
            if(array_key_exists($goods_id,$cart)){
                //2 购物车已经有该商品  数量累加
                $cart[$goods_id] += $num;
            }else{
                //1 购物车没有该商品   直接添加到数组
                $cart[$goods_id] = $num;
            }
            //将购车数据保存回cookie
            $cookies = \Yii::$app->response->cookies;
            $cookie = new Cookie([
                'name'=>'cart',
                'value'=>serialize($cart)
            ]);
            $cookies->add($cookie);
            //跳转到购物车页面
        }else{
            $cart=new Cart();
            //1 检查购物车有没有该商品(根据goods_id member_id查询)
            $data=Cart::find()->where(['goods_id'=>$goods_id,'member_id'=>\Yii::$app->user->id])->one();
             //1.1 有该商品  数量累加
            if($data){
                $data->amount+=$num;
                $data->update();
            }else{
                //1.2 没有该商品  添加到数据表
                $cart->goods_id=$goods_id;
                $cart->amount=$num;
                $cart->member_id=\Yii::$app->user->id;
                $cart->save();
            }
        }

        return $this->redirect(['shop/cart']);
    }
    public function actionCart(){
        $this->layout='cart';
        if(\Yii::$app->user->isGuest){
            //将商品id和数量从cookie取出
            $cookies = \Yii::$app->request->cookies;
            $cookie = $cookies->get('cart');
            if($cookie == null){//购物车cookie不存在
                $cart = [];
            }else{//购物车cookie存在
                $cart = unserialize($cookie->value);
            }
        }else{
            //用户已登录，从数据表获取购物车数据
            $cart=[];
            $goods = Cart::find()->where(['member_id'=>\Yii::$app->user->id])/*->asArray()*/->all();
            foreach ($goods as $good){
                $cart[$good->goods_id]=$good->amount;
            }
        /*    var_dump($cart);
            exit;*/
        }
        //[[id=>1,logo=>'',name=>'',price=>'','num'=>2],[]]
        $models = [];
        //循环获取商品数据，构造购物车需要的格式
        foreach($cart as $id=>$num){
            $goods = Goods::find()->where(['id'=>$id])->asArray()->one();
            $goods['num']=$num;
            $models[]=$goods;
        }
   /*         var_dump($models);
        exit();*/
        return $this->render('cart',['models'=>$models]);
    }
    /*
    * 修改购物车商品数量
    * $filter = modify   del
    */
    public function actionAjax($filter)
    {
        switch ($filter) {
            case 'modify':
                //修改商品数量 goods_id  num
                $goods_id = \Yii::$app->request->post('goods_id');
                $num = \Yii::$app->request->post('num');

                if (\Yii::$app->user->isGuest) {
                    $cookies = \Yii::$app->request->cookies;
                    $cookie = $cookies->get('cart');
                    if ($cookie == null) {//购物车cookie不存在
                        $cart = [];
                    } else {//购物车cookie存在
                        $cart = unserialize($cookie->value);
                    }

                    $cart[$goods_id] = $num;
                    ///将购车数据保存回cookie
                    $cookies = \Yii::$app->response->cookies;
                    $cookie = new Cookie([
                        'name' => 'cart',
                        'value' => serialize($cart)
                    ]);

                    /*$cookies->add($cookie);*/
                              /*var_dump($cookies);
                              exit;*/
                   /* \Yii::$app->cartCookie->updateCart($goods_id, $num)->save();*/
                }
                return 'success';
                break;

            case 'del':
                //删除商品
                $goods_id = \Yii::$app->request->post('goods_id');

                if (\Yii::$app->user->isGuest) {
                    $cookies = \Yii::$app->request->cookies;
                    $cookie = $cookies->get('cart');
                    if ($cookie == null) {//购物车cookie不存在
                        $cart = [];
                    } else {//购物车cookie存在
                        $cart = unserialize($cookie->value);
                    }
                    //清除购物车中该id对应的商品
                    unset($cart[$goods_id]);
                    //将购车数据保存回cookie
                    $cookies = \Yii::$app->response->cookies;
                    $cookie = new Cookie([
                        'name' => 'cart',
                        'value' => serialize($cart)
                    ]);

                    $cookies->add($cookie);
                    /*           $cart = new CookieHandler();
                               $cart->delCart($goods_id);
                               $cart->save();*/

                    /*\Yii::$app->cartCookie->delCart($goods_id)->save();*/
                    return 'success';
                }
                break;
        }
    }

};


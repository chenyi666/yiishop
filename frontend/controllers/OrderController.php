<?php

namespace frontend\controllers;

use backend\models\Goods;
use frontend\models\Address;
use frontend\models\Cart;
use frontend\models\Order;
use frontend\models\OrderDetail;
use yii\base\Model;
use yii\db\Exception;

class OrderController extends \yii\web\Controller
{
    public function actionIndex()
    {
            if (\Yii::$app->user->isGuest) {
                //未登录的时候，跳转到登录页面，当他登录后将购物车的数据保存到数据表中

            } else {
                $model=new Order();
                //不是游客的话展示订单页面
                $this->layout = 'order';
                //获取用户地址信息
                $addresses=Address::find()->where(['member_id'=>\Yii::$app->user->id])->all();
                //获取购物车信息
                $carts=Cart::find()->where(['member_id'=>\Yii::$app->user->id])->all();
                return $this->render('index',['addresses'=>$addresses,'model'=>$model,'carts'=>$carts]);
            }

        }
        public function actionAdd(){
            $model=new Order();
          if($model->load(\Yii::$app->request->post()) && $model->validate()){
              $model->member_id=\Yii::$app->user->id;
              //通过address_id获取用户收货地址信息
              $address=Address::findOne(['id'=>$model->address_id]);
              $model->name=$address->name;
              $model->province_name=$address->province;
              $model->city_name=$address->city;
              $model->area_name=$address->area;
              $model->detail_address=$address->detail;
              $model->tel=$address->tel;
              $model->delivery_id=$model->deliveries_id;
              $model->delivery_name=Order::$deliveries[$model->deliveries_id][0];
              $model->delivery_price=Order::$deliveries[$model->deliveries_id][1];
              $model->delivery_price=Order::$deliveries[$model->deliveries_id][1];
              $model->pay_type_name=Order::$payments[$model->pay_type_id][0];
              $model->trode_no=rand(100000,999999);
              $model->status=1;
              $model->create_time=time();
              $db=\Yii::$app->db;
              $transaction = $db->beginTransaction();
               try {
                  $model->save();
            /*      var_dump($model->getErrors());exit;*/
                  $carts = Cart::find()->where(['member_id' => $model->member_id])->all();

                  foreach ($carts as $cart) {
                      $detail = new OrderDetail();
                      $detail->order_id = $model->id;
                      $detail->goods_id = $cart->goods_id;
                      $detail->goods_name = $cart->goods->name;
                      $detail->logo = $cart->goods->logo;
                      $detail->price = $cart->goods->shop_price;
                      $detail->num = $cart->amount;
                      $detail->total_price = $detail->price * $detail->num;
                      if($cart->amount > $cart->goods->stock){
                          throw new Exception('商品'.$cart->goods->name.'的库存不足');
                      }
                      $detail->save(false);
                  }
                  $transaction->commit();
              }catch (Exception $e){
                  \Yii::$app->session->setFlash('danger',$e);
                  $transaction->rollBack();
              }

          };

        }



}

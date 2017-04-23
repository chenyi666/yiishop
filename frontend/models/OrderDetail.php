<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "order_detail".
 *
 * @property integer $id
 * @property string $order_id
 * @property string $goods_id
 * @property string $goods_name
 * @property string $logo
 * @property string $price
 * @property integer $num
 * @property string $total_price
 */
class OrderDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'goods_id', 'num'], 'integer'],
            [['goods_name', 'logo', 'price', 'num', 'total_price'], 'required'],
            [['price', 'total_price'], 'number'],
            [['goods_name', 'logo'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => '订单id',
            'goods_id' => '商品id',
            'goods_name' => '商品名称',
            'logo' => 'LOGO',
            'price' => '价格',
            'num' => '数量',
            'total_price' => '小计',
        ];
    }
}

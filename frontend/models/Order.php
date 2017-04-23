<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $member_id
 * @property string $name
 * @property string $province_name
 * @property string $city_name
 * @property string $area_name
 * @property string $detail_address
 * @property integer $tel
 * @property string $delivery_id
 * @property string $delivery_name
 * @property string $delivery_price
 * @property string $pay_type_id
 * @property string $pay_type_name
 * @property string $price
 * @property integer $status
 * @property string $trode_no
 * @property string $create_time
 */
class Order extends \yii\db\ActiveRecord
{
    public static $deliveries=[
        1=>['顺丰快递',50,'三天内到达'],
        2=>['中通',40,'两天内到达'],
        3=>['门店自提',10,'就近门店随时可以领取'],
    ];
    public static $payments=[
        1=>['货到付款','收到货物后现金支付'],
        2=>['支付宝','支付宝支付'],
        3=>['微信','微信支付'],
    ];
    public $address_id;
    public $deliveries_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'pay_type_id','address_id','deliveries_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'member_id' => '用户ID',
            'name' => '收货人',
            'province_name' => '省份',
            'city_name' => '城市',
            'area_name' => '地区',
            'detail_address' => '详细地址',
            'tel' => '联系电话',
            'delivery_id' => '配送方式ID',
            'delivery_name' => '配送方式的名字',
            'delivery_price' => '运费',
            'pay_type_id' => '支付方式ID',
            'pay_type_name' => '支付方式',
            'price' => '商品金额',
            'status' => '订单状态',
            'trode_no' => '第三方支付的交易号',
            'create_time' => '添加时间',
        ];
    }
}

<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "goods".
 *
 * @property integer $id
 * @property string $name
 * @property string $sn
 * @property string $logo
 * @property integer $goods_category_id
 * @property string $brand_id
 * @property string $shop_price
 * @property string $market_price
 * @property integer $is_on_sale
 * @property integer $status
 * @property integer $sort
 * @property integer $inputtime
 */
class Goods extends \yii\db\ActiveRecord
{
    public $depth;
    public $logo_file;
    public static $status_zt=[1=>'正常',0=>'回收站'];
    public static $is_on_sale=[0=>'否',1=>'是'];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'goods_category_id', 'brand_id', 'shop_price', 'market_price', 'is_on_sale', 'status', 'sort', ], 'required'],
            [['goods_category_id', 'is_on_sale', 'status', 'sort',], 'integer'],
            [['shop_price', 'market_price'], 'number'],
            [['name'], 'string', 'max' => 50],
            [['logo_file'], 'file', 'extensions' => ['jpg','png','gif'],'skipOnEmpty'=>false],
            [['brand_id'], 'string', 'max' => 255],
            ['depth', 'compare', 'compareValue' => 2, 'operator' => '>=','message'=>'必须添加在第三级']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'sn' => '商品编号',
            'logo_file' => 'LOGO',
            'goods_category_id' => '商品分类',
            'brand_id' => '品牌',
            'shop_price' => '本店价格',
            'market_price' => '市场价格',
            'is_on_sale' => '是否上架',
            'status' => '状态',
            'sort' => '排序',
            'inputtime' => '录入时间',

        ];
    }
    public function getCate(){
        return $this->hasOne(GoodsCategory::className(),['id'=>'goods_id']);
    }
    public function getBrand(){
        return $this->hasOne(Brand::className(),['id'=>'brand_id']);
    }
    public function logoUrl()
    {
        //   http://www    0
        //   123http://www    3
        // 123   false
        if(strpos($this->logo,'http://')===false){
            return '@web'.$this->logo;
        }
        return $this->logo;
    }
}

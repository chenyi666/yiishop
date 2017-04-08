<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property string $name
 * @property string $logo
 * @property string $intro
 * @property integer $sort
 * @property integer $status
 */
class Brand extends \yii\db\ActiveRecord
{
   /* public $logo_file;*/
    public static $status_zt=[-1=>'删除',0=>'隐藏',1=>'正常'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','status','sort','logo'], 'required'],
            [['intro'], 'string'],
            [['sort', 'status'], 'integer'],
            [['name'], 'string', 'max' => 50],
            /*[['logo_file'], 'file', 'extensions' => ['jpg','png','gif'],'skipOnEmpty'=>false],*/
       /*   [['logo_file'],'image']*/
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '品牌名',
            'logo' => 'LOGO',
            'intro' => '简介',
            'sort' => '排序',
            'status' => '状态',
        ];
    }
    /*
     * 处理图片地址
     * 如果是本地图片,添加@web别名
     * 如果是远程图片,不做处理
     */
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

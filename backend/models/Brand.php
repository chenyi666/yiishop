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
}

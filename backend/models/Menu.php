<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property string $url
 * @property string $intro
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'],'unique'],
            [['name'], 'required'],
            [['parent_id'], 'integer'],
            [['url'], 'safe'],
            [['name', 'intro'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '菜单名',
            'parent_id' => '上级菜单',
            'url' => '权限（路由）',
            'intro' => '描述',
        ];
    }
    /*//获取分类option
    public static function getOption(){

        $cate=Menu::->find()->all();
        //获取分类信息
        $option=ArrayHelper::merge(['0'=>'顶级分类',$cate]);
    }*/
    //建立菜单和其之类的关系
    public function getChild(){
        return $this->hasMany($this,['parent_id'=>'id']);
    }
}

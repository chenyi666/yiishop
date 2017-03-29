<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $name
 * @property integer $article_category_id
 * @property string $intro
 * @property integer $sort
 * @property integer $status
 * @property integer $inputtime
 */
class Article extends \yii\db\ActiveRecord
{
    public static $status_zt=[0=>'否',1=>'是'];
    public $content;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'article_category_id', 'sort', 'status','content'], 'required'],
            [['article_category_id', 'sort', 'status', 'inputtime'], 'integer'],
            [['intro'], 'string'],
            [['content'], 'string', 'min' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '文章名字',
            'article_category_id' => '文章分类',
            'intro' => '简介',
            'sort' => '排序',
            'status' => '是否显示',
            'inputtime' => '录入时间',
            'content'=>'内容'
        ];
    }
    public function getCate(){
        return $this->hasOne(ArticleCategory::className(),['id'=>'article_category_id']);
    }
}

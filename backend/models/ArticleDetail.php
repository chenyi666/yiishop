<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "article_detail".
 *
 * @property integer $id
 * @property string $article_id
 * @property string $content
 */
class ArticleDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_id', 'content'], 'required'],
            [['content'], 'string'],
            [['article_id'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_id' => '文章名',
            'content' => '文章内容',
        ];
    }
}

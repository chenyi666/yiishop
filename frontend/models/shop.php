<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/11
 * Time: 17:00
 */

namespace frontend\models;


use backend\models\Article;
use backend\models\ArticleCategory;
use backend\models\GoodsCategory;
use yii\db\ActiveRecord;

class shop extends ActiveRecord
{
    public static function getCate(){
        //获取分类数据
        $cates=GoodsCategory::find()->where(['parent_id'=>0])->all();
        return $cates;
    }
    public  static function getArticle(){
        //获取文章分类
        $articles_cates=ArticleCategory::find()->all();
        return $articles_cates;
    }
}
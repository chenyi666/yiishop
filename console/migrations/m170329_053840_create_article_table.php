<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article`.
 */
class m170329_053840_create_article_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'name'=>$this->string()->notNull()->comment('文章名字'),
            'article_category_id'=>$this->integer(10)->notNull()->comment('文章分类'),
            'intro'=>$this->text()->comment('简介'),
            'sort'=>$this->integer(10)->notNull()->comment('排序'),
            'status'=>$this->integer()->notNull()->comment('是否显示'),
            'inputtime'=>$this->integer()->notNull()->comment('录入时间'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article');
    }
}

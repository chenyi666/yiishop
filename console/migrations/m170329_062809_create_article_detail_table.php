<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_detail`.
 */
class m170329_062809_create_article_detail_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article_detail', [
            'id' => $this->primaryKey(),
            'article_id'=>$this->string(50)->notNull()->comment('文章名'),
            'content'=>$this->text()->notNull()->comment('文章内容')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article_detail');
    }
}

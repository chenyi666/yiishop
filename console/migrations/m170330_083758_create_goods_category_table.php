<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_category`.
 */
class m170330_083758_create_goods_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods_category', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(50)->notNull()->comment('名称'),
            'parent_id'=>$this->integer(3)->notNull()->defaultValue(0)->comment('父分类'),
            'left'=>$this->integer(3)->notNull()->comment('左边界'),
            'right'=>$this->integer(3)->notNull()->comment('右边界'),
            'depth'=>$this->integer(50)->notNull()->comment('级别'),
            'intro'=>$this->text()->notNull()->comment('简介'),
            'tree'=>$this->integer()->notNull()->defaultValue(0)->comment('树')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods_category');
    }
}

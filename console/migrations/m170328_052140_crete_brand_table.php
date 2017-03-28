<?php

use yii\db\Migration;

class m170328_052140_crete_brand_table extends Migration
{
    public function up()
    {
        $this->createTable('brand',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string(50)->notNull()->comment('品牌名'),
            'logo'=>$this->string(100)->notNull()->comment('LOGO'),
            'intro'=>$this->text()->comment('简介'),
            'sort'=>$this->integer(20)->notNull()->defaultValue(20)->comment('排序'),
            'status'=>$this->integer(1)->notNull()->defaultValue(1)->comment('状态')
        ]);
    }

    public function down()
    {
        echo "m170328_052140_crete_brand_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}

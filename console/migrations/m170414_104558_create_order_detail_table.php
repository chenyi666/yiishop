<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order_detail`.
 */
class m170414_104558_create_order_detail_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('order_detail', [
            'id' => $this->primaryKey(),
            'order_id'=>$this->integer(10)->unsigned()->notNull()->defaultValue(0)->comment('订单id'),
            'goods_id'=>$this->integer(10)->unsigned()->notNull()->defaultValue(0)->comment('商品id'),
            'goods_name'=>$this->string()->notNull()->comment('商品名称'),
            'logo'=>$this->string()->notNull()->comment('LOGO'),
            'price'=>$this->decimal()->notNull()->comment('价格'),
            'num'=>$this->integer()->notNull()->comment('数量'),
            'total_price'=>$this->decimal()->notNull()->comment('小计'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('order_detail');
    }
}

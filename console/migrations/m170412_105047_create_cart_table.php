<?php

use yii\db\Migration;

/**
 * Handles the creation of table `cart`.
 */
class m170412_105047_create_cart_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('cart', [
            'id' => $this->primaryKey(),
            'goods_id'=>$this->integer()->notNull()->comment('商品'),
            'amount'=>$this->integer()->notNull()->comment('数量'),
            'member_id'=>$this->integer()->notNull()->comment('用户ID'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('cart');
    }
}

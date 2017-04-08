<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods`.
 */
class m170401_021103_create_goods_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(50)->notNull()->comment('名称'),
            'sn'=>$this->string(15)->notNull()->comment('商品编号'),
            'logo'=>$this->string(150)->notNull()->comment('LOGO'),
            'goods_category_id'=>$this->integer(3)->notNull()->comment('商品分类'),
            'brand_id'=>$this->string()->notNull()->comment('品牌'),
            'shop_price'=>$this->decimal(10,2)->notNull()->comment('本店价格'),
            'market_price'=>$this->decimal(10,2)->notNull()->comment('市场价格'),
            'is_on_sale'=>$this->integer(4)->notNull()->comment('是否上架'),
            'status'=>$this->integer(4)->notNull()->comment('状态'),
            'sort'=>$this->integer(4)->notNull()->comment('排序'),
            'inputtime'=>$this->integer(11)->notNull()->comment('录入时间'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods');
    }
}

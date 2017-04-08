<?php

use yii\db\Migration;

/**
 * Handles the creation of table `menu`.
 */
class m170406_030316_create_menu_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('menu', [
            'id' => $this->primaryKey(),
            'name'=>$this->string()->notNull()->comment('菜单名'),
            'parent_id'=>$this->integer()->notNull()->defaultValue(0)->comment('上级菜单'),
            'url'=>$this->string()->notNull()->comment('权限（路由）'),
            'intro'=>$this->string()->comment('描述'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('menu');
    }
}

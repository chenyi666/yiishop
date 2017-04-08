<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin`.
 */
class m170402_023911_create_admin_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('admin', [
            'id' => $this->primaryKey(),
            'username'=>$this->string()->unique()->notNull()->comment('用户名'),
            'password'=>$this->string()->notNull()->comment('密码'),
            'email'=>$this->string()->unique()->notNull()->comment('邮箱'),
            'token'=>$this->string()->notNull()->comment('自动登录令牌'),
            'token_create_time'=>$this->string()->defaultValue(null)->comment('令牌创建时间'),
            'addtime'=>$this->integer()>notNull()->defaultValue(0)->comment('注册时间'),
            'last_login_time'=>$this->integer()->notNull()->defaultValue(0)->comment('最后登录时间'),
            'last_login_ip'=>$this->string()->defaultValue(null)->comment('最后登录IP'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('admin');
    }
}

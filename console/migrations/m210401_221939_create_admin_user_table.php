<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%admin_user}}`.
 */
class m210401_221939_create_admin_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%admin_user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'password_hash' => $this->string()->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->insert('{{%admin_user}}', [
            'username' => 'admin',
            'email' => 'admin@admin.test',
            'status' => 10,
            'auth_key' => '',
            'password_hash' => Yii::$app->security->generatePasswordHash('12345678'),
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%admin_user}}');
    }
}

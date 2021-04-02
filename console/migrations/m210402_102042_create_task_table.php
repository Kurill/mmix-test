<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task}}`.
 */
class m210402_102042_create_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task}}', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer()->notNull(),
            'creator_id' => $this->integer()->notNull(),
            'executor_id' => $this->integer()->null(),
            'title' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'file' => $this->string()->null(),
        ]);

        $this->addForeignKey(
            'project_fk',
            '{{%task}}',
            ['project_id'],
            '{{%project}}',
            'id'
        );

        $this->addForeignKey(
            'creator_fk',
            '{{%task}}',
            ['creator_id'],
            '{{%user}}',
            'id'
        );

        $this->addForeignKey(
            'executor_fk',
            '{{%task}}',
            ['executor_id'],
            '{{%user}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%task}}');
    }
}

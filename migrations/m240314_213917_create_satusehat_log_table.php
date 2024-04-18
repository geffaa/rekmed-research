<?php

use yii\db\Migration;

/**
 * Handles the creation of table `satusehat_log`.
 */
class m240314_213917_create_satusehat_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('satusehat_log', [
            'id' => $this->primaryKey(),
            'response_code' => $this->string()->notNull(),
            'action' => $this->string(),
            'url' => $this->string()->notNull(),
            'payload' => $this->text(),
            'response' => $this->text(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);
        $this->addForeignKey(
            'fk-satusehat_log-user_id',
            'satusehat_log',
            'user_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-satusehat_log-user_id', 'satusehat_log');
        $this->dropTable('satusehat_log');
    }
}

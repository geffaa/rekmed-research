<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%satusehat_log}}`.
 */
class m240314_213917_create_satusehat_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%satusehat_log}}', [
            'id' => $this->primaryKey(),
            'response_id' => $this->string()->null(),
            'action' => $this->string()->notNull(),
            'url' => $this->string()->notNull(),
            'payload' => $this->text()->null(),
            'response' => $this->text()->notNull(),
            'user_id' => $this->string()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%satusehat_log}}');
    }
}

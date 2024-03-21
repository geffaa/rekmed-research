<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%satusehat_token}}`.
 */
class m240314_212318_create_satusehat_token_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%satusehat_token}}', [
            'id' => $this->primaryKey(),
            'environment' => $this->string(),
            'token' => $this->text(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%satusehat_token}}');
    }
}

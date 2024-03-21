<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%satusehat_icd10}}`.
 */
class m240314_223118_create_satusehat_icd10_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%satusehat_icd10}}', [
            'id' => $this->primaryKey(),
            'icd10_code' => $this->string()->notNull(),
            'icd10_en' => $this->text()->notNull(),
            'icd10_id' => $this->text()->null(),
            'active' => $this->boolean()->defaultValue(true),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%satusehat_icd10}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%satusehat_token}}`.
 */
class m240315_042259_add_expires_at_column_to_satusehat_token_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%satusehat_token}}', 'expires_at', $this->integer()->notNull()->comment('Token expiration time'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%satusehat_token}}', 'expires_at');
    }
}

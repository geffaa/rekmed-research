<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%dokter}}`.
 */
class m240502_004421_add_no_nik_column_to_dokter_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('dokter', 'no_nik', $this->string()->after('user_id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('dokter', 'no_nik');
    }
}

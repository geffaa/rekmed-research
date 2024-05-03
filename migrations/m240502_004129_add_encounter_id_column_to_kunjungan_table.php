<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%kunjungan}}`.
 */
class m240502_004129_add_encounter_id_column_to_kunjungan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('kunjungan', 'encounter_id', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('kunjungan', 'encounter_id');
    }
}

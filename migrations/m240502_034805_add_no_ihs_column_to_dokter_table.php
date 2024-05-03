<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%dokter}}`.
 */
class m240502_034805_add_no_ihs_column_to_dokter_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('dokter', 'no_ihs', $this->string()->after('no_nik'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('dokter', 'no_ihs');
    }
}

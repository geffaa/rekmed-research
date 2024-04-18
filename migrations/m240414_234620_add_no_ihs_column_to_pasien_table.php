<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `pasien`.
 */
class m240414_234620_add_no_ihs_column_to_pasien_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('pasien', 'no_ihs', $this->string()->after('no_nik'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('pasien', 'no_ihs');
    }
}

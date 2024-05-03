<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%klinik}}`.
 */
class m240502_004711_add_location_organization_column_to_klinik_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('klinik', 'organization_id', $this->string()->after('klinik_id'));
        $this->addColumn('klinik', 'location_id', $this->string()->after('organization_id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('klinik', 'organization_id');
        $this->dropColumn('klinik', 'location_id');
    }
}

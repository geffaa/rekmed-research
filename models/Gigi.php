<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gigi".
 *
 * @property int $gigi_id
 * @property string $nama
 * @property int $posisi
 *
 * @property Odontogram[] $odontograms
 * @property RmGigi[] $rmGigis
 */
class Gigi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gigi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gigi_id', 'nama', 'posisi'], 'required'],
            [['gigi_id', 'posisi'], 'integer'],
            [['nama'], 'string', 'max' => 255],
            [['gigi_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'gigi_id' => 'Gigi ID',
            'nama' => 'Nama',
            'posisi' => 'Posisi',
        ];
    }

    /**
     * Gets query for [[Odontograms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOdontograms()
    {
        return $this->hasMany(Odontogram::class, ['gigi_id' => 'gigi_id']);
    }

    /**
     * Gets query for [[RmGigis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRmGigis()
    {
        return $this->hasMany(RmGigi::class, ['rm_gigi_id' => 'rm_gigi_id'])->viaTable('odontogram', ['gigi_id' => 'gigi_id']);
    }
}

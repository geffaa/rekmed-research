<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "status_gigi".
 *
 * @property int $status_gigi_id
 * @property string $nama
 * @property string|null $gambar
 *
 * @property Odontogram[] $odontograms
 */
class StatusGigi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status_gigi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status_gigi_id', 'nama'], 'required'],
            [['status_gigi_id'], 'integer'],
            [['gambar'], 'string'],
            [['nama'], 'string', 'max' => 255],
            [['status_gigi_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'status_gigi_id' => 'Status Gigi ID',
            'nama' => 'Nama',
            'gambar' => 'Gambar',
        ];
    }

    /**
     * Gets query for [[Odontograms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOdontograms()
    {
        return $this->hasMany(Odontogram::class, ['status_gigi_id' => 'status_gigi_id']);
    }
}

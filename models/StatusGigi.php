<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "status_gigi".
 *
 * @property int $status_gigi_id
 * @property string|null $path
 * @property string|null $nama
 * @property int $z_index
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
            [['path'], 'string'],
            [['z_index'], 'integer'],
            [['nama'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'status_gigi_id' => 'Status Gigi ID',
            'path' => 'Path',
            'nama' => 'Nama',
            'z_index' => 'Z Index',
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

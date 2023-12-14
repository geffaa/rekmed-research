<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gigi".
 *
 * @property int $gigi_id
 * @property int $nomor
 * @property string|null $nama
 * @property int $default_status_gigi
 *
 * @property StatusGigi $defaultStatusGigi
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
            [['nomor', 'default_status_gigi'], 'required'],
            [['nomor', 'default_status_gigi'], 'integer'],
            [['nama'], 'string', 'max' => 255],
            [['nomor'], 'unique'],
            [['default_status_gigi'], 'exist', 'skipOnError' => true, 'targetClass' => StatusGigi::class, 'targetAttribute' => ['default_status_gigi' => 'status_gigi_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'gigi_id' => 'Gigi ID',
            'nomor' => 'Nomor',
            'nama' => 'Nama',
            'default_status_gigi' => 'Default Status Gigi',
        ];
    }

    /**
     * Gets query for [[DefaultStatusGigi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDefaultStatusGigi()
    {
        return $this->hasOne(StatusGigi::class, ['status_gigi_id' => 'default_status_gigi']);
    }
    public static function findByNomor($nomor)
    {
        return static::findOne(['nomor' => $nomor]);
    }
}

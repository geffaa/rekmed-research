<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rawat_inap".
 *
 * @property int $rawat_inap_id
 * @property string $mr
 *
 * @property Pasien $mr0
 * @property RiRecord[] $riRecords
 */
class RawatInap extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rawat_inap';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mr'], 'required'],
            [['mr'], 'string', 'max' => 25],
            [['mr'], 'exist', 'skipOnError' => true, 'targetClass' => Pasien::class, 'targetAttribute' => ['mr' => 'mr']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rawat_inap_id' => 'Rawat Inap ID',
            'mr' => 'Mr',
        ];
    }

    /**
     * Gets query for [[Mr0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMr0()
    {
        return $this->hasOne(Pasien::class, ['mr' => 'mr']);
    }

    /**
     * Gets query for [[RiRecords]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRiRecords()
    {
        return $this->hasMany(RiRecord::class, ['rawat_inap_id' => 'rawat_inap_id']);
    }
}

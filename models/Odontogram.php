<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "odontogram".
 *
 * @property int $rm_gigi_id
 * @property int $gigi_id
 * @property int $status_gigi_id
 *
 * @property Gigi $gigi
 * @property RmGigi $rmGigi
 * @property StatusGigi $statusGigi
 */
class Odontogram extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'odontogram';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rm_gigi_id', 'gigi_id', 'status_gigi_id'], 'required'],
            [['rm_gigi_id', 'gigi_id', 'status_gigi_id'], 'integer'],
            [['rm_gigi_id', 'gigi_id'], 'unique', 'targetAttribute' => ['rm_gigi_id', 'gigi_id']],
            [['rm_gigi_id'], 'exist', 'skipOnError' => true, 'targetClass' => RmGigi::class, 'targetAttribute' => ['rm_gigi_id' => 'rm_gigi_id']],
            [['gigi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gigi::class, 'targetAttribute' => ['gigi_id' => 'gigi_id']],
            [['status_gigi_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusGigi::class, 'targetAttribute' => ['status_gigi_id' => 'status_gigi_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rm_gigi_id' => 'Rm Gigi ID',
            'gigi_id' => 'Gigi ID',
            'status_gigi_id' => 'Status Gigi ID',
        ];
    }

    /**
     * Gets query for [[Gigi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGigi()
    {
        return $this->hasOne(Gigi::class, ['gigi_id' => 'gigi_id']);
    }

    /**
     * Gets query for [[RmGigi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRmGigi()
    {
        return $this->hasOne(RmGigi::class, ['rm_gigi_id' => 'rm_gigi_id']);
    }

    /**
     * Gets query for [[StatusGigi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatusGigi()
    {
        return $this->hasOne(StatusGigi::class, ['status_gigi_id' => 'status_gigi_id']);
    }
}

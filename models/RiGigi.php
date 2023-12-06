<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ri_gigi".
 *
 * @property int $ri_gigi_id
 * @property int $rm_gigi_id
 * @property string $tanggal
 * @property string|null $gigi
 * @property string|null $keluhan_diagnosa
 * @property string|null $perawatan
 * @property int $user_id
 * @property int|null $is_verified
 *
 * @property RmGigi $rmGigi
 * @property User $user
 */
class RiGigi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ri_gigi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rm_gigi_id', 'tanggal', 'user_id'], 'required'],
            [['rm_gigi_id', 'user_id', 'is_verified'], 'integer'],
            [['tanggal'], 'safe'],
            [['gigi', 'keluhan_diagnosa', 'perawatan'], 'string'],
            [['rm_gigi_id'], 'exist', 'skipOnError' => true, 'targetClass' => RmGigi::class, 'targetAttribute' => ['rm_gigi_id' => 'rm_gigi_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ri_gigi_id' => 'Ri Gigi ID',
            'rm_gigi_id' => 'Rm Gigi ID',
            'tanggal' => 'Tanggal',
            'gigi' => 'Gigi',
            'keluhan_diagnosa' => 'Keluhan/Diagnosa',
            'perawatan' => 'Perawatan',
            'user_id' => 'User ID',
            'is_verified' => 'Is Verified',
        ];
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
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}

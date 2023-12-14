<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ri_record".
 *
 * @property int $ri_record_id
 * @property int $rawat_inap_id
 * @property string $tanggal
 * @property string|null $subjective
 * @property string|null $objective
 * @property string|null $assessment
 * @property string|null $plan
 * @property int|null $is_verified
 * @property int|null $is_removed
 * @property int $user_id
 *
 * @property RawatInap $rawatInap
 * @property User $user
 */
class RiRecord extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ri_record';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rawat_inap_id', 'tanggal', 'user_id'], 'required'],
            [['rawat_inap_id', 'is_verified', 'is_removed', 'user_id'], 'integer'],
            [['tanggal'], 'safe'],
            [['subjective', 'objective', 'assessment', 'plan'], 'string'],
            [['rawat_inap_id'], 'exist', 'skipOnError' => true, 'targetClass' => RawatInap::class, 'targetAttribute' => ['rawat_inap_id' => 'rawat_inap_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ri_record_id' => 'Ri Record ID',
            'rawat_inap_id' => 'Rawat Inap ID',
            'tanggal' => 'Tanggal',
            'subjective' => 'Subjective',
            'objective' => 'Objective',
            'assessment' => 'Assessment',
            'plan' => 'Plan',
            'is_verified' => 'Is Verified',
            'is_removed' => 'Is Removed',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[RawatInap]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRawatInap()
    {
        return $this->hasOne(RawatInap::class, ['rawat_inap_id' => 'rawat_inap_id']);
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

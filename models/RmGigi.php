<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rm_gigi".
 *
 * @property int $rm_gigi_id
 * @property int $rm_id
 * @property string|null $oklusi
 * @property string|null $torus_palatinus
 * @property string|null $torus_mandibularis
 * @property string|null $palatum
 * @property string|null $supernumerary_teeth
 * @property string|null $diastema
 * @property string|null $gigi_anomali
 * @property string|null $lain_lain
 *
 * @property Gigi[] $gigis
 * @property Odontogram[] $odontograms
 * @property RiGigi[] $riGigis
 * @property RekamMedi $rm
 */
class RmGigi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rm_gigi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rm_id'], 'required'],
            [['rm_id'], 'integer'],
            [['oklusi', 'torus_palatinus', 'torus_mandibularis', 'palatum', 'supernumerary_teeth', 'diastema', 'gigi_anomali', 'lain_lain'], 'string'],
            [['rm_id'], 'exist', 'skipOnError' => true, 'targetClass' => RekamMedi::class, 'targetAttribute' => ['rm_id' => 'rm_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rm_gigi_id' => 'Rm Gigi ID',
            'rm_id' => 'Rm ID',
            'oklusi' => 'Oklusi',
            'torus_palatinus' => 'Torus Palatinus',
            'torus_mandibularis' => 'Torus Mandibularis',
            'palatum' => 'Palatum',
            'supernumerary_teeth' => 'Supernumerary Teeth',
            'diastema' => 'Diastema',
            'gigi_anomali' => 'Gigi Anomali',
            'lain_lain' => 'Lain Lain',
        ];
    }

    /**
     * Gets query for [[Gigis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGigis()
    {
        return $this->hasMany(Gigi::class, ['gigi_id' => 'gigi_id'])->viaTable('odontogram', ['rm_gigi_id' => 'rm_gigi_id']);
    }

    /**
     * Gets query for [[Odontograms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOdontograms()
    {
        return $this->hasMany(Odontogram::class, ['rm_gigi_id' => 'rm_gigi_id']);
    }

    /**
     * Gets query for [[RiGigis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRiGigis()
    {
        return $this->hasMany(RiGigi::class, ['rm_gigi_id' => 'rm_gigi_id']);
    }

    /**
     * Gets query for [[Rm]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRm()
    {
        return $this->hasOne(RekamMedi::class, ['rm_id' => 'rm_id']);
    }
}

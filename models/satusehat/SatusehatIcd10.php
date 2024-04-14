<?php

namespace app\models\satusehat;

use Yii;

/**
 * This is the model class for table "rekmed_satusehat_icd10".
 *
 * @property int $id
 * @property string $icd10_code
 * @property string $icd10_en
 * @property string|null $icd10_id
 * @property int|null $active
 * @property string $created_at
 * @property string $updated_at
 */
class SatusehatIcd10 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rekmed_satusehat_icd10';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['icd10_code', 'icd10_en'], 'required'],
            [['icd10_en', 'icd10_id'], 'string'],
            [['active'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['icd10_code'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'icd10_code' => 'Icd10 Code',
            'icd10_en' => 'Icd10 En',
            'icd10_id' => 'Icd10 ID',
            'active' => 'Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}

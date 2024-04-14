<?php

namespace app\models\satusehat;

use Yii;

/**
 * This is the model class for table "rekmed_satusehat_log".
 *
 * @property int $id
 * @property string|null $response_id
 * @property string $action
 * @property string $url
 * @property string|null $payload
 * @property string $response
 * @property string $user_id
 * @property string $created_at
 * @property string $updated_at
 */
class SatusehatLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rekmed_satusehat_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['action', 'url', 'user_id'], 'required'],
            [['payload', 'response'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['response_id', 'action', 'url', 'user_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'response_id' => 'Response ID',
            'action' => 'Action',
            'url' => 'Url',
            'payload' => 'Payload',
            'response' => 'Response',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}

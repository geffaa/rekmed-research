<?php

namespace app\models\satusehat;

use Yii;
use app\models\User;
/**
 * This is the model class for table "satusehat_log".
 *
 * @property int $id
 * @property string $response_code
 * @property string|null $action
 * @property string $url
 * @property string|null $payload
 * @property string|null $response
 * @property int $user_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $user
 */
class SatusehatLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'satusehat_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['response_code', 'url', 'user_id'], 'required'],
            [['payload', 'response'], 'string'],
            [['user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['response_code', 'action', 'url'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'response_code' => 'Response Code',
            'action' => 'Action',
            'url' => 'Url',
            'payload' => 'Payload',
            'response' => 'Response',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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

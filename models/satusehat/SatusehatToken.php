<?php

namespace app\models\satusehat;

use Yii;

/**
 * This is the model class for table "rekmed_satusehat_token".
 *
 * @property int $id
 * @property string|null $environment
 * @property string|null $token
 * @property string $created_at
 * @property string $updated_at
 * @property int $expires_at
 */
class SatusehatToken extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rekmed_satusehat_token';
    }

    // Set the primary key to be 'token'
    public static function primaryKey()
    {
        return ['token']; 
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['token'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['environment'], 'string', 'max' => 255],
            [['expires_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'environment' => 'Environment',
            'token' => 'Token',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'expires_at' => 'Expires At',
        ];
    }
    /**
     * Saves the OAuth2 token to the database.
     * 
     * @param string $token The OAuth2 token to save.
     * @param int $expiresIn The token expiration time in seconds.
     * @return bool Whether the token was saved successfully.
     */
    public static function saveToken($token, $expiresIn)
    {
        $model = new self();
        $model->token = $token;
        $model->expires_at = time() + $expiresIn; // Calculate expiration time
        return $model->save();
    }

    /**
     * Checks if the token is valid (not expired).
     * 
     * @return bool Whether the token is valid.
     */
    public function isValid()
    {
        // Get the current time
        $currentTime = time();
        // Check if the token has expired
        return $this->expires_at > $currentTime;
    }
        /**
     * Finds a valid token that has not expired.
     *
     * @return SatusehatToken|null The valid token, or null if no valid token is found.
     */
    public static function findValidToken()
    {
        return static::find()
            ->where(['>', 'expires_at', time()])
            ->orderBy(['expires_at' => SORT_DESC])
            ->one();
    }
}

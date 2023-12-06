<?php

namespace app\components;
use Yii;

class EncryptionHelper
{
    /**
     * Encrypts a value using a specific key.
     *
     * @param string $value The value to be encrypted.
     * @return string The encrypted value.
     */
    public static function encrypt($value)
    {
        return utf8_encode(Yii::$app->security->encryptByKey($value, Yii::$app->params['kunciInggris']));
    }
    
    /**
     * Decrypts a value using a specific key.
     *
     * @param string $encryptedValue The value to be decrypted.
     * @return string The decrypted value.
     */
    public static function decrypt($encryptedValue)
    {
        return Yii::$app->security->decryptByKey(utf8_decode($encryptedValue), Yii::$app->params['kunciInggris']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $user_name
 * @property string $name
 * @property string $password_hash
 * @property string $auth_key
 * @property string $access_token
 *
 * @property Incident[] $incidents
 * @property Log[] $logs
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_name', 'name', 'password_hash', 'auth_key', 'access_token'], 'required'],
            [['id'], 'integer'],
            [['user_name'], 'string', 'max' => 50],
            [['name', 'password_hash'], 'string', 'max' => 175],
            [['auth_key', 'access_token'], 'string', 'max' => 128],
            [['access_token'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_name' => 'User Name',
            'name' => 'Name',
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncidents()
    {
        return $this->hasMany(Incident::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogs()
    {
        return $this->hasMany(Log::className(), ['user_id' => 'id']);
    }
}

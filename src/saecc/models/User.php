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
	public $password_repeat;
	
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
            [['user_name', 'name', 'password_hash', 'auth_key', 'access_token'], 'required'],
            [['user_name'], 'string', 'max' => 20],
            //[['name', 'password_hash'], 'string', 'max' => 175],
			[['name', 'password_hash'], 'string', 'max' => 175],
			['password_repeat', 'compare', 'compareAttribute' => 'password_hash'],
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

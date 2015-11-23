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
class User extends \yii\db\ActiveRecord implements
\yii\web\IdentityInterface
{
	public $password_repeat;
	public $password;
	
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
//[['user_name', 'name', 'password_hash', 'auth_key', 'access_token'], 'required'],
			[['user_name', 'name'], 'required'],
			[['password'], 'required', 'except' => ['update']],
//[['user_name'], 'string', 'max' => 20],
			[['user_name', 'password'], 'string', 'max' => 20],
//[['name', 'password_hash'], 'string', 'max' => 175],
			[['name'], 'string', 'max' => 175],
			['password_repeat', 'compare', 'compareAttribute' => 'password'],
//[['auth_key', 'access_token'], 'string', 'max' => 128],
//[['access_token'], 'unique']
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
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
        ];
    }

	public function beforeSave($insert)
	{
		if(parent::beforeSave($insert))
		{
			if($this->isNewRecord)
			{
				$this->password_hash = Yii::$app->getSecurity()->
				generatePasswordHash($this->password);
				$this->auth_key = Yii::$app->getSecurity()->
				generateRandomString();
				$this->access_token = Yii::$app->getSecurity()->
				generateRandomString();
			}else
			{
				if(!empty($this->password))
				{
					$this->password_hash = Yii::$app->getSecurity()->
					generatePasswordHash($this->password);
				}
			}
			return true;
		}
		return false;
	}
	
	/**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
		return self::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }
        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($userName)
    {
        return self::findOne(['user_name'=>$userName]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        // return $this->password === $password;
		return Yii::$app->getSecurity()->validatePassword($password,
		$this->password_hash);
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

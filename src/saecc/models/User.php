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
 * @property integer $active
 *
 * @property Incident[] $incidents
 * @property Log[] $logs
 */
class User extends \yii\db\ActiveRecord implements
\yii\web\IdentityInterface
{
	public $password_repeat;
	public $password;
	public $rol;
	
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
			[['active'], 'integer'],
			[['user_name', 'name'], 'required'],
			[['password'], 'required', 'except' => ['update']],
			[['user_name', 'password'], 'string', 'max' => 20],
			[['rol'], 'in', 'range'=>['operator','administrator','normaluser']],
			[['name'], 'string', 'max' => 175],
			['password_repeat', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_name' => Yii::t('app', 'User Name'),
            'name' => Yii::t('app', 'Name'),
            'password' => Yii::t('app', 'Password'),
			'password_repeat' => Yii::t('app', 'Password Repeat'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'access_token' => Yii::t('app', 'Access Token'),
			'active' => Yii::t('app', 'Active'),
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
				// creas codigo para asignar permiso
			}else
			{
				if(!empty($this->password))
				{
					$this->password_hash = Yii::$app->getSecurity()->
					generatePasswordHash($this->password);
				}
				// creas codigo para desasignar y luego asignar permiso
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

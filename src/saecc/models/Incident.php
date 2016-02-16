<?php

namespace app\models;

use Yii;
use yii\validators\DefaultValueValidators;

/**
 * This is the model class for table "incident".
 *
 * @property string $id
 * @property string $date
 * @property string $equipment_id
 * @property string $room_id
 * @property string $description
 * @property integer $solved
 * @property string $date_solved
 * @property string $client_id
 * @property string $user_id
 *
 * @property Client $client
 * @property Equipment $equipment
 * @property Room $room
 * @property User $user
 */
class Incident extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'incident';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['room_id', 'description', 'user_id'], 'required'],
            [['date', 'date_solved'], 'safe'],			
            [['equipment_id', 'room_id', 'solved', 'client_id', 'user_id'], 'integer'],
            [['description'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'date' => Yii::t('app', 'Date'),
            'equipment_id' => Yii::t('app', 'Equipment ID'),
            'room_id' => Yii::t('app', 'Room ID'),
            'description' => Yii::t('app', 'Description'),
            'solved' => Yii::t('app', 'Solved'),
            'date_solved' => Yii::t('app', 'Date Solved'),
            'client_id' => Yii::t('app', 'Client ID'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'client_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipment()
    {
        return $this->hasOne(Equipment::className(), ['id' => 'equipment_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Room::className(), ['id' => 'room_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
	
	public function beforeSave($insert)
	{
		if(parent::beforeSave($insert))
		{
			if($this->isNewRecord)
			{				
				$this->date = new \yii\db\Expression('NOW()'); // crear fecha			
				//$this->date = date('Y-m-d'); // crear fecha
				//$this->start_time = date('H:i:s'); // crear hora inicial
				// crear duracion
				// calcular hora final y asignarla
				
				return true;
			}
			else
			{
				// actualizar hora final y duracion
			}
		}
	}
}

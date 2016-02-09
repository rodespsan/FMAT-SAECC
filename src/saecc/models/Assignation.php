<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "assignation".
 *
 * @property string $id
 * @property string $date
 * @property string $client_id
 * @property string $room_id
 * @property string $location_id
 * @property string $equipment_id
 * @property string $purpose
 * @property string $duration
 * @property string $start_time
 * @property string $end_time
 *
 * @property Client $client
 * @property Equipment $equipment
 * @property Location $location
 * @property Room $room
 */
class Assignation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'assignation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [	
			//[['date'], 'default', 'on'=>'insert', 'value' => new \yii\db\Expression('NOW()')],		
			//[['date'], 'default', 'on'=>'insert', 'value' => new date()],		
            [['client_id', 'room_id', 'location_id', 'equipment_id', 'duration', 'start_time', 'end_time'], 'required'],
            [['date', 'start_time', 'end_time'], 'safe'],			
            [['client_id', 'room_id', 'location_id', 'equipment_id', 'duration'], 'integer'],
            [['purpose'], 'string', 'max' => 170]
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
            'client_id' => Yii::t('app', 'Client ID'),
            'room_id' => Yii::t('app', 'Room ID'),
            'location_id' => Yii::t('app', 'Location ID'),
            'equipment_id' => Yii::t('app', 'Equipment ID'),
            'purpose' => Yii::t('app', 'Purpose'),
            'duration' => Yii::t('app', 'Duration'),
            'start_time' => Yii::t('app', 'Start Time'),
            'end_time' => Yii::t('app', 'End Time'),
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
    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['id' => 'location_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Room::className(), ['id' => 'room_id']);
    }
	
	public function beforeSave($insert)
	{
		if(parent::beforeSave($insert))
		{
			if($this->isNewRecord)
			{
				date_default_timezone_set("America/Mexico_City");
				$this->date = date("Y-m-d H:i:s"); // crear fecha
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

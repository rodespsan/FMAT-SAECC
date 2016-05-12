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
 * @property First Name $first_name
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
			[['client_id', 'room_id', 'location_id', 'equipment_id', 'duration'], 'required'],
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
	
	//Convierte horas a minutos: "03:34.11" a "214"
	public function hoursToMinutes($hours)
	{
		$minutes = 0;
		if (strpos($hours, ':') !== false)
		{
			// Split hours and minutes.
			list($hours, $minutes) = explode(':', $hours);
		}
		return $hours * 60 + $minutes;
	}
	
	public function beforeSave($insert)
	{		
		if(parent::beforeSave($insert))
		{
			if($this->isNewRecord)
			{								
				//registra la fecha en que se genera una asignación
				$this->date = new \yii\db\Expression('NOW()');
				
				//Calcula y asigna la hora en que terminará una asignación en base a la duración seleccionada
				if($this->start_time == "00:00:00"){
					$this->start_time = new \yii\db\Expression('NOW()');
					
					switch($this->duration)
					{
						case 15:
							$this->end_time = date("H:i:s", strtotime('+15 min'));
							break; 
						case 30:
							$this->end_time = date("H:i:s", strtotime('+30 min'));
							break;
						case 45:
							$this->end_time = date("H:i:s", strtotime('+45 min'));
							break;
						case 60:
							$this->end_time = date("H:i:s", strtotime('+60 min'));							
							break;
						case 90:
							$this->end_time = date("H:i:s", strtotime('+90 min'));
							break;
						case 120:
							$this->end_time = date("H:i:s", strtotime('+120 min'));
							break; 
					}
				}else{
					//Permite reservar equipos tomando como hora inicical la de la reservación y calcula la hora final en base a esta.
					switch($this->duration)
					{
						case 15:
							$this->end_time = date('H:i:s',strtotime( '+15 min' , strtotime ($this->start_time)));												
							break;
						case 30:
							$this->end_time = date('H:i:s',strtotime( '+30 min' , strtotime ($this->start_time)));
							break;
						case 45:
							$this->end_time = date('H:i:s',strtotime( '+45 min' , strtotime ($this->start_time)));
							break;
						case 60:
							$this->end_time = date('H:i:s',strtotime( '+60 min' , strtotime ($this->start_time)));
							break;
						case 90:
							$this->end_time = date('H:i:s',strtotime( '+90 min' , strtotime ($this->start_time)));
							break;
						case 120:
							$this->end_time = date('H:i:s',strtotime( '+120 min' , strtotime ($this->start_time)));
							break;
					}
				}
				
				return true;
			}
			else
			{
				//Actualiza la hora final y la duracion de la asignación
				switch($this->duration)
				{
					case 15:
						$this->end_time = date('H:i:s',strtotime( '+15 min' , strtotime ($this->start_time)));												
						break;
					case 30:
						$this->end_time = date('H:i:s',strtotime( '+30 min' , strtotime ($this->start_time)));
						break;
					case 45:
						$this->end_time = date('H:i:s',strtotime( '+45 min' , strtotime ($this->start_time)));
						break;
					case 60:
						$this->end_time = date('H:i:s',strtotime( '+60 min' , strtotime ($this->start_time)));
						break;
					case 90:
						$this->end_time = date('H:i:s',strtotime( '+90 min' , strtotime ($this->start_time)));
						break;
					case 120:
						$this->end_time = date('H:i:s',strtotime( '+120 min' , strtotime ($this->start_time)));
						break;
				}

				return true;
			}
		}
	}
}

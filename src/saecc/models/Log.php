<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "log".
 *
 * @property string $id
 * @property string $user_id
 * @property string $date
 * @property string $log_type_id
 * @property string $equipment_type
 * @property string $inventory
 * @property string $equipment_id
 * @property string $location
 * @property string $equipment_status_id
 *
 * @property Equipment $equipment
 * @property LogType $logType
 * @property EquipmentStatus $equipmentStatus
 * @property User $user
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [			
            [['user_id', 'date', 'log_type_id', 'equipment_id', 'location_id', 'equipment_status_id'], 'required'],
            [['user_id', 'log_type_id', 'equipment_id', 'equipment_status_id'], 'integer'],
            [['date'], 'safe'],            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'date' => Yii::t('app', 'Date'),
            'log_type_id' => Yii::t('app', 'Log Type ID'),            
            'equipment_id' => Yii::t('app', 'Equipment ID'),            
            'location_id' => Yii::t('app', 'Location'),
            'equipment_status_id' => Yii::t('app', 'Equipment Status ID'),
        ];
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
    public function getLogType()
    {
        return $this->hasOne(LogType::className(), ['id' => 'log_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipmentStatus()
    {
        return $this->hasOne(EquipmentStatus::className(), ['id' => 'equipment_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['id' => 'location_id']);
    }
}

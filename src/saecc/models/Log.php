<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "log".
 *
 * @property string $id
 * @property string $equipment_id
 * @property string $user_id
 * @property string $status_id
 * @property string $date
 * @property string $room_id
 * @property string $location
 * @property string $log_type_id
 *
 * @property Equipment $equipment
 * @property LogType $logType
 * @property Status $status
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
            [['equipment_id', 'user_id', 'status_id', 'date', 'room_id', 'location', 'log_type_id'], 'required'],
            [['equipment_id', 'user_id', 'status_id', 'room_id', 'log_type_id'], 'integer'],
            [['date'], 'safe'],
            [['location'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'equipment_id' => 'Equipment ID',
            'user_id' => 'User ID',
            'status_id' => 'Status ID',
            'date' => 'Date',
            'room_id' => 'Room ID',
            'location' => 'Location',
            'log_type_id' => 'Log Type ID',
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
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}

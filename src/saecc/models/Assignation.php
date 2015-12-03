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
 * @property string $location
 * @property string $equipment_id
 * @property string $purpose
 * @property string $start_time
 * @property string $end_time
 * @property string $duration
 *
 * @property Client $client
 * @property Equipment $equipment
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
            [['date', 'client_id', 'room_id', 'location', 'equipment_id', 'start_time', 'end_time', 'duration'], 'required'],
            [['date', 'start_time', 'end_time'], 'safe'],
            [['client_id', 'room_id', 'equipment_id', 'duration'], 'integer'],
            [['location'], 'string', 'max' => 45],
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
            'client_id' => Yii::t('app', 'Client'),
            'room_id' => Yii::t('app', 'Room'),
            'location' => Yii::t('app', 'Location'),
            'equipment_id' => Yii::t('app', 'Equipment'),
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
    public function getRoom()
    {
        return $this->hasOne(Room::className(), ['id' => 'room_id']);
    }
}

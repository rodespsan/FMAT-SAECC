<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "assignation".
 *
 * @property string $id
 * @property string $client_id
 * @property string $equipment_id
 * @property string $location
 * @property string $room_id
 * @property string $start_date
 * @property string $end_date
 * @property string $duration
 * @property string $purpose
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
            [['client_id', 'equipment_id', 'location', 'room_id', 'start_date', 'end_date', 'duration'], 'required'],
            [['client_id', 'equipment_id', 'room_id', 'duration'], 'integer'],
            [['start_date', 'end_date'], 'safe'],
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
            'id' => 'ID',
            'client_id' => 'Client',
            'equipment_id' => 'Equipment',
            'location' => 'Location',
            'room_id' => 'Room',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'duration' => 'Duration',
            'purpose' => 'Purpose',
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

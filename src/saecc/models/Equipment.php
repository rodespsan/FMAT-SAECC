<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "equipment".
 *
 * @property string $id
 * @property string $inventory
 * @property string $description
 * @property string $serial_number
 * @property string $status_id
 * @property string $room_id
 * @property string $location
 * @property integer $available
 * @property string $type_id
 *
 * @property Assignation[] $assignations
 * @property Room $room
 * @property Status $status
 * @property EquipmentType $type
 * @property Incident[] $incidents
 * @property Log[] $logs
 */
class Equipment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'equipment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['inventory', 'description', 'serial_number', 'status_id', 'room_id', 'location', 'type_id'], 'required'],
            [['status_id', 'room_id', 'available', 'type_id'], 'integer'],
            [['inventory'], 'string', 'max' => 30],
            [['description', 'serial_number'], 'string', 'max' => 175],
            [['location'], 'string', 'max' => 45],
            [['inventory'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'inventory' => 'Inventory',
            'description' => 'Description',
            'serial_number' => 'Serial Number',
            'status_id' => 'Status ',
            'room_id' => 'Room ',
            'location' => 'Location',
            'available' => 'Available',
            'type_id' => 'Type ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssignations()
    {
        return $this->hasMany(Assignation::className(), ['equipment_id' => 'id']);
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
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(EquipmentType::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncidents()
    {
        return $this->hasMany(Incident::className(), ['equipment_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogs()
    {
        return $this->hasMany(Log::className(), ['equipment_id' => 'id']);
    }
}

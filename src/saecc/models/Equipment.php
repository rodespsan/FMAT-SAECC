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
 * @property string $equipment_status_id
 * @property string $room_id
 * @property string $location_id
 * @property integer $available
 * @property string $type_id
 *
 * @property Assignation[] $assignations
 * @property Room $room
 * @property EquipmentStatus $equipmentStatus
 * @property EquipmentType $type
 * @property Location $location
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
            [['inventory', 'description', 'serial_number', 'equipment_status_id', 'room_id', 'type_id'], 'required'],
            [['equipment_status_id', 'room_id', 'location_id', 'available', 'type_id'], 'integer'],
            [['inventory'], 'string', 'max' => 30],
            [['description', 'serial_number'], 'string', 'max' => 175],
            [['inventory'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'inventory' => Yii::t('app', 'Inventory'),
            'description' => Yii::t('app', 'Description'),
            'serial_number' => Yii::t('app', 'Serial Number'),
            'equipment_status_id' => Yii::t('app', 'Equipment Status ID'),
            'room_id' => Yii::t('app', 'Room ID'),
            'location_id' => Yii::t('app', 'Location ID'),
            'available' => Yii::t('app', 'Available'),
            'type_id' => Yii::t('app', 'Type ID'),
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
    public function getEquipmentStatus()
    {
        return $this->hasOne(EquipmentStatus::className(), ['id' => 'equipment_status_id']);
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
    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['id' => 'location_id']);
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

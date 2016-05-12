<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "equipment".
 *
 * @property string $id
 * @property string $inventory
 * @property string $equipment_type_id
 * @property string $description
 * @property string $serial_number
 * @property string $equipment_status_id
 * @property string $location_id
 * @property integer $available
 *
 * @property Assignation[] $assignations
 * @property EquipmentStatus $equipmentStatus
 * @property EquipmentType $equipmentType
 * @property Location $location
 * @property Incident[] $incidents
 * @property Log[] $logs
 */
class Equipment extends \yii\db\ActiveRecord
{
	public $room_id;
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
            [['inventory', 'equipment_type_id', 'description', 'serial_number', 'equipment_status_id'], 'required'],
            [['equipment_type_id', 'equipment_status_id', 'location_id', 'available'], 'integer'],
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
            'equipment_type_id' => Yii::t('app', 'Equipment Type ID'),
            'description' => Yii::t('app', 'Description'),
            'serial_number' => Yii::t('app', 'Serial Number'),
            'equipment_status_id' => Yii::t('app', 'Equipment Status ID'),
            'room_id' => Yii::t('app', 'Room ID'),
            'location_id' => Yii::t('app', 'Location ID'),
            'available' => Yii::t('app', 'Available'),
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
    public function getEquipmentStatus()
    {
        return $this->hasOne(EquipmentStatus::className(), ['id' => 'equipment_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipmentType()
    {
        return $this->hasOne(EquipmentType::className(), ['id' => 'equipment_type_id']);
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
	
	public function getNameWithInventory()
	{
		return $this->equipmentType->name." (".$this->inventory.")";
	}
}

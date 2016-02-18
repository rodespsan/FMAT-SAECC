<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "location".
 *
 * @property string $id
 * @property string $location
 * @property string $room_id
 * @property integer $active
 *
 * @property Assignation[] $assignations
 * @property Equipment[] $equipments
 * @property Room $room
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['location', 'room_id'], 'required'],
            [['room_id', 'active'], 'integer'],
            [['location'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'location' => Yii::t('app', 'Location'),
            'room_id' => Yii::t('app', 'Room ID'),
			'active' => Yii::t('app', 'Active'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssignations()
    {
        return $this->hasMany(Assignation::className(), ['location_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipments()
    {
        return $this->hasMany(Equipment::className(), ['location_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Room::className(), ['id' => 'room_id']);
    }
}

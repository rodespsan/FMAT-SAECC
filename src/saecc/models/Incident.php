<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "incident".
 *
 * @property string $id
 * @property string $date
 * @property string $equipment_id
 * @property string $room_id
 * @property string $description
 * @property integer $solved
 * @property string $date_solved
 * @property string $client_id
 * @property string $user_id
 *
 * @property Client $client
 * @property Equipment $equipment
 * @property Room $room
 * @property User $user
 */
class Incident extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'incident';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'room_id', 'description', 'user_id'], 'required'],
            [['date', 'date_solved'], 'safe'],
            [['equipment_id', 'room_id', 'solved', 'client_id', 'user_id'], 'integer'],
            [['description'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'equipment_id' => 'Equipment ID',
            'room_id' => 'Room ID',
            'description' => 'Description',
            'solved' => 'Solved',
            'date_solved' => 'Date Solved',
            'client_id' => 'Client ID',
            'user_id' => 'User ID',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}

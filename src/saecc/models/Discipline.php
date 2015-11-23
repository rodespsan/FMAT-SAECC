<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "discipline".
 *
 * @property string $id
 * @property string $school_id
 * @property string $name
 * @property string $short_name
 * @property string $area_id
 *
 * @property Client[] $clients
 * @property Area $area
 * @property School $school
 */
class Discipline extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'discipline';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['school_id', 'name', 'short_name', 'area_id'], 'required'],
            [['school_id', 'area_id'], 'integer'],
            [['name'], 'string', 'max' => 175],
            [['short_name'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'school_id' => 'School',
            'name' => 'Name',
            'short_name' => 'Short Name',
            'area_id' => 'Area',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClients()
    {
        return $this->hasMany(Client::className(), ['discipline_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArea()
    {
        return $this->hasOne(Area::className(), ['id' => 'area_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchool()
    {
        return $this->hasOne(School::className(), ['id' => 'school_id']);
    }
}

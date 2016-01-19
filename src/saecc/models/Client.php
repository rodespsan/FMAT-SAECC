<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client".
 *
 * @property string $id
 * @property string $client_id
 * @property string $first_name
 * @property string $last_name
 * @property string $client_type_id
 * @property string $discipline_id
 * @property integer $active
 *
 * @property Assignation[] $assignations
 * @property Discipline $discipline
 * @property ClientType $clientType
 * @property Incident[] $incidents
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_id', 'first_name', 'last_name', 'client_type_id'], 'required'],
            [['client_type_id', 'discipline_id', 'active'], 'integer'],
            [['client_id'], 'string', 'max' => 30],
            [['first_name', 'last_name'], 'string', 'max' => 175],
            [['client_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'client_id' => Yii::t('app', 'Client ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'client_type_id' => Yii::t('app', 'Client Type ID'),
            'discipline_id' => Yii::t('app', 'Discipline ID'),
            'active' => Yii::t('app', 'Active'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssignations()
    {
        return $this->hasMany(Assignation::className(), ['client_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscipline()
    {
        return $this->hasOne(Discipline::className(), ['id' => 'discipline_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientType()
    {
        return $this->hasOne(ClientType::className(), ['id' => 'client_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncidents()
    {
        return $this->hasMany(Incident::className(), ['client_id' => 'id']);
    }
}

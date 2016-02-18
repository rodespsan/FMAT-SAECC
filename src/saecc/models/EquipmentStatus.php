<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "equipment_status".
 *
 * @property string $id
 * @property string $status
 * @property integer $active
 *
 * @property Equipment[] $equipments
 * @property Log[] $logs
 */
class EquipmentStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'equipment_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['active'], 'integer'],
            [['status'], 'required'],
            [['status'], 'string', 'max' => 45],
            [['status'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'status' => Yii::t('app', 'Status'),
			'active' => Yii::t('app', 'Active'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipments()
    {
        return $this->hasMany(Equipment::className(), ['status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogs()
    {
        return $this->hasMany(Log::className(), ['status_id' => 'id']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "equipment_type".
 *
 * @property string $id
 * @property string $name
 * @property integer $active
 *
 * @property Equipment[] $equipments
 */
class EquipmentType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'equipment_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['active'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 45],
            [['name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
			'active' => Yii::t('app', 'Active'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipments()
    {
        return $this->hasMany(Equipment::className(), ['type_id' => 'id']);
    }
}

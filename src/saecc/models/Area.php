<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "area".
 *
 * @property string $id
 * @property string $name
 * @property integer $active
 *
 * @property Discipline[] $disciplines
 */
class Area extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'area';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['active'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 175],
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
    public function getDisciplines()
    {
        return $this->hasMany(Discipline::className(), ['area_id' => 'id']);
    }
}

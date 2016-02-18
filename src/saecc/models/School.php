<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "school".
 *
 * @property string $id
 * @property string $name
 *
 * @property Discipline[] $disciplines
 */
class School extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'school';
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
        return $this->hasMany(Discipline::className(), ['school_id' => 'id']);
    }
}

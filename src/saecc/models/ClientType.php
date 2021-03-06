<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client_type".
 *
 * @property string $id
 * @property string $type
 * @property integer $active
 *
 * @property Client[] $clients
 */
class ClientType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['active'], 'integer'],
            [['type'], 'required'],
            [['type'], 'string', 'max' => 45],
            [['type'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
			'active' => Yii::t('app', 'Active'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClients()
    {
        return $this->hasMany(Client::className(), ['client_type_id' => 'id']);
    }
}

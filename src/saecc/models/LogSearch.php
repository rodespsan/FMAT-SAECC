<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Log;

/**
 * LogSearch represents the model behind the search form about `app\models\Log`.
 */
class LogSearch extends Log
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'log_type_id', 'equipment_id', 'room_id', 'equipment_status_id'], 'integer'],
            [['date', 'equipment_type', 'inventory', 'location'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Log::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'date' => $this->date,
            'log_type_id' => $this->log_type_id,
            'equipment_id' => $this->equipment_id,
            'room_id' => $this->room_id,
            'equipment_status_id' => $this->equipment_status_id,
        ]);

        $query->andFilterWhere(['like', 'equipment_type', $this->equipment_type])
            ->andFilterWhere(['like', 'inventory', $this->inventory])
            ->andFilterWhere(['like', 'location', $this->location]);

        return $dataProvider;
    }
}

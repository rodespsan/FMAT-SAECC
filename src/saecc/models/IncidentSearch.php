<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Incident;

/**
 * IncidentSearch represents the model behind the search form about `app\models\Incident`.
 */
class IncidentSearch extends Incident
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'equipment_id', 'room_id', 'solved', 'client_id', 'user_id'], 'integer'],
            [['date', 'description', 'date_solved'], 'safe'],
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
        $query = Incident::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'equipment_id' => $this->equipment_id,
            'room_id' => $this->room_id,
            'solved' => $this->solved,
            'date_solved' => $this->date_solved,
            'client_id' => $this->client_id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}

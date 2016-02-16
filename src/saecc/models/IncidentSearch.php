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
	public $equipment;
	public $room;
	public $client;
	public $user;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['id', 'equipment_id', 'room_id', 'solved', 'client_id', 'user_id'], 'integer'],
            //[['date', 'description', 'date_solved'], 'safe'],
			[['id', 'solved'], 'integer'],
            [['date', 'description', 'date_solved', 'equipment', 'room', 'client', 'user'], 'safe'],
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
		$query->joinWith(['equipment', 'room', 'client', 'user']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		
		$dataProvider->sort->attributes['equipment'] = [
			// The tables are the ones our relation are configured to
			// in my case they are prefixed with "tbl_"
			'asc' => ['equipment.inventory' => SORT_ASC],
			'desc' => ['equipment.inventory' => SORT_DESC],
		];
		
		$dataProvider->sort->attributes['room'] = [
			// The tables are the ones our relation are configured to
			// in my case they are prefixed with "tbl_"
			'asc' => ['room.name' => SORT_ASC],
			'desc' => ['room.name' => SORT_DESC],
		];
		
		$dataProvider->sort->attributes['client'] = [
			// The tables are the ones our relation are configured to
			// in my case they are prefixed with "tbl_"
			'asc' => ['client.client_id' => SORT_ASC],
			'desc' => ['client.client_id' => SORT_DESC],
		];
		
		$dataProvider->sort->attributes['user'] = [
			// The tables are the ones our relation are configured to
			// in my case they are prefixed with "tbl_"
			'asc' => ['user.user_name' => SORT_ASC],
			'desc' => ['user.user_name' => SORT_DESC],
		];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            //'equipment_id' => $this->equipment_id,
            //'room_id' => $this->room_id,
            'solved' => $this->solved,
            'date_solved' => $this->date_solved,
            //'client_id' => $this->client_id,
            //'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'incident.description', $this->description])
		->andFilterWhere(['like', 'equipment.inventory', $this->equipment])
		->andFilterWhere(['like', 'room.name', $this->room])
		->andFilterWhere(['like', 'client.client_id', $this->client])
		->andFilterWhere(['like', 'user.user_name', $this->user]);		

        return $dataProvider;
    }
}

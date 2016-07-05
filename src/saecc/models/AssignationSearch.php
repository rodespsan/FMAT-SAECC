<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Assignation;

/**
 * AssignationSearch represents the model behind the search form about `app\models\Assignation`.
 */
class AssignationSearch extends Assignation
{
	public $client;
	public $room;
	public $location;
	public $equipment;
	public $full_name;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'duration'], 'integer'],
            [['date', 'purpose', 'start_time', 'end_time', 'client', 'room', 'location', 'equipment', 'full_name'], 'safe'],
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
		$query = Assignation::find();
		$query->joinWith(['client', 'room', 'location', 'equipment']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'sort' => [
				'defaultOrder' => [
					'date' => SORT_DESC,
				]
			],
			'pagination' => [
				'pageSize' => 1000,
			],
        ]);
		
		$dataProvider->sort->attributes['client'] = [
			// The tables are the ones our relation are configured to
			// in my case they are prefixed with "tbl_"
			'asc' => ['client.client_id' => SORT_ASC],
			'desc' => ['client.client_id' => SORT_DESC],
		];
		
		$dataProvider->sort->attributes['full_name'] = [
			// The tables are the ones our relation are configured to
			// in my case they are prefixed with "tbl_"
			'asc' => ['client.full_name' => SORT_ASC],
			'desc' => ['client.full_name' => SORT_DESC],
		];
		
		$dataProvider->sort->attributes['room'] = [
			// The tables are the ones our relation are configured to
			// in my case they are prefixed with "tbl_"
			'asc' => ['room.name' => SORT_ASC],
			'desc' => ['room.name' => SORT_DESC],
		];
		
		$dataProvider->sort->attributes['location'] = [
			// The tables are the ones our relation are configured to
			// in my case they are prefixed with "tbl_"
			'asc' => ['location.location' => SORT_ASC],
			'desc' => ['location.location' => SORT_DESC],
		];
		
		$dataProvider->sort->attributes['equipment'] = [
			// The tables are the ones our relation are configured to
			// in my case they are prefixed with "tbl_"
			'asc' => ['equipment.inventory' => SORT_ASC],
			'desc' => ['equipment.inventory' => SORT_DESC],
		];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            //'date' => $this->date,
            //'client_id' => $this->client_id,
            //'room_id' => $this->room_id,
            //'location_id' => $this->location_id,
            //'equipment_id' => $this->equipment_id,
            'duration' => $this->duration,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
        ]);

        $query->andFilterWhere(['like', 'purpose', $this->purpose])
			->andFilterWhere(['like', 'date', $this->date])
			->andFilterWhere(['like', 'client.client_id', $this->client])		
			->andFilterWhere(['like', 'client.full_name', $this->full_name])		
            ->andFilterWhere(['like', 'room.id', $this->room])
			->andFilterWhere(['like', 'location.id', $this->location])
			->andFilterWhere(['like', 'equipment.inventory', $this->equipment]);

        return $dataProvider;
    }
}

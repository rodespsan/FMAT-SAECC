<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Location;

/**
 * LocationSearch represents the model behind the search form about `app\models\Location`.
 */
class LocationSearch extends Location
{
	public $room;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'active'], 'integer'],
            [['location', 'room'], 'safe'],
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
        $query = Location::find();
		$query->joinWith(['room']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		$dataProvider->sort->attributes['room'] = [
			// The tables are the ones our relation are configured to
			// in my case they are prefixed with "tbl_"
			'asc' => ['room.name' => SORT_ASC],
			'desc' => ['room.name' => SORT_DESC],
		];
		
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            //'room_id' => $this->room_id,
			'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'location', $this->location])
			->andFilterWhere(['like', 'room.name', $this->room]);

        return $dataProvider;
    }
}

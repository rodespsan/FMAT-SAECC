<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Client;

/**
 * ClientSearch represents the model behind the search form about `app\models\Client`.
 */
class ClientSearch extends Client
{
	public $clientType;
	public $discipline;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'active'], 'integer'],
            [['client_id', 'first_name', 'last_name', 'clientType', 'discipline'], 'safe'],
            //[['id'], 'integer'],
            //[['client_id', 'first_name', 'last_name', 'clientType', 'discipline', 'active'], 'safe'],
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
        $query = Client::find();
		$query->joinWith(['clientType','discipline']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		
		$dataProvider->sort->attributes['clientType'] = [
			// The tables are the ones our relation are configured to
			// in my case they are prefixed with "tbl_"
			'asc' => ['client_type.type' => SORT_ASC],
			'desc' => ['client_type.type' => SORT_DESC],
		];
		
		$dataProvider->sort->attributes['discipline'] = [
			// The tables are the ones our relation are configured to
			// in my case they are prefixed with "tbl_"
			'asc' => ['discipline.name' => SORT_ASC],
			'desc' => ['discipline.name' => SORT_DESC],
		];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            //'client_type_id' => $this->client_type_id,
            //'discipline_id' => $this->discipline_id,
            'active' => $this->active,
			//'active' => ($this->active) ? 'Si' : 'No',
        ]);

        $query->andFilterWhere(['like', 'client_id', $this->client_id])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
			->andFilterWhere(['like', 'client_type.type', $this->clientType])
			->andFilterWhere(['like', 'discipline.name', $this->discipline]);
			//->andFilterWhere(['like', 'active', ($this->active) ? 'Si' : 'No']);

        return $dataProvider;
    }
}

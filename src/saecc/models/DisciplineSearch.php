<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Discipline;

/**
 * DisciplineSearch represents the model behind the search form about `app\models\Discipline`.
 */
class DisciplineSearch extends Discipline
{
	public $area;
	public $school;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'short_name', 'school', 'area'], 'safe'],
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
        $query = Discipline::find();
		$query->joinWith(['area', 'school']);
		
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		
		$dataProvider->sort->attributes['area'] = [
			// The tables are the ones our relation are configured to
			// in my case they are prefixed with "tbl_"
			'asc' => ['area.name' => SORT_ASC],
			'desc' => ['area.name' => SORT_DESC],
		];
		
		$dataProvider->sort->attributes['school'] = [
			// The tables are the ones our relation are configured to
			// in my case they are prefixed with "tbl_"
			'asc' => ['school.name' => SORT_ASC],
			'desc' => ['school.name' => SORT_DESC],
		];

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            //'school_id' => $this->school_id,
            //'area_id' => $this->area_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'short_name', $this->short_name])
			->andFilterWhere(['like', 'area.name', $this->area])
			->andFilterWhere(['like', 'school.name', $this->school]);

        return $dataProvider;
    }
}

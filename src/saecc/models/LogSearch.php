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
	public $user;
	public $logType;
	public $equipmentType;	
	public $equipment;
	public $room;
	public $location;
	public $equipmentStatus;		
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [            
			[['id'], 'integer'],
            [['user', 'date', 'logType', 'equipmentType', 'equipment', 'room', 'location', 'equipmentStatus'], 'safe'],
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
		$query->joinWith(['user', 'logType', 'equipment.equipmentType', 'equipment', 'equipment.room', 'location', 'equipmentStatus']);
		
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		
		$dataProvider->sort->attributes['user'] = [
			// The tables are the ones our relation are configured to
			// in my case they are prefixed with "tbl_"
			'asc' => ['user.name' => SORT_ASC],
			'desc' => ['user.name' => SORT_DESC],
		];
		
		$dataProvider->sort->attributes['logType'] = [
			// The tables are the ones our relation are configured to
			// in my case they are prefixed with "tbl_"
			'asc' => ['log_type.type' => SORT_ASC],
			'desc' => ['log_type.type' => SORT_DESC],
		];
		
		$dataProvider->sort->attributes['equipmentType'] = [
			// The tables are the ones our relation are configured to
			// in my case they are prefixed with "tbl_"
			'asc' => ['equipment_type.name' => SORT_ASC],
			'desc' => ['equipment_type.name' => SORT_DESC],
		];						
		
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
		
		$dataProvider->sort->attributes['location'] = [
			// The tables are the ones our relation are configured to
			// in my case they are prefixed with "tbl_"
			'asc' => ['location.location' => SORT_ASC],
			'desc' => ['location.location' => SORT_DESC],
		];
		
		$dataProvider->sort->attributes['equipmentStatus'] = [
			// The tables are the ones our relation are configured to
			// in my case they are prefixed with "tbl_"
			'asc' => ['equipment_status.status' => SORT_ASC],
			'desc' => ['equipment_status.status' => SORT_DESC],
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
        ]);

        $query->andFilterWhere(['like', 'user.name', $this->user])
			->andFilterWhere(['like', 'log_type.type', $this->logType])
			->andFilterWhere(['like', 'equipment_type.name', $this->equipmentType])
			->andFilterWhere(['like', 'equipment.inventory', $this->equipment])
			->andFilterWhere(['like', 'room.name', $this->room])
			->andFilterWhere(['like', 'location.location', $this->location])
			->andFilterWhere(['like', 'equipment_status.status', $this->equipmentStatus]);            

        return $dataProvider;
    }
}

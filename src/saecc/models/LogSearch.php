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
	public $equipment;
	public $equipmentStatus;
	
	public $equipmentType;
	public $inventory;
	public $location;
	public $room;
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'room_id'], 'integer'],
            [['date', 'inventory', 'location', 'user', 'logType', 'equipment', 'equipmentStatus'
				, 'equipmentType' //, 'inventory', 'location', 'room',
			], 'safe'],
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
		$query->joinWith(['user', 'logType', 'equipment', 'equipment.equipmentType', 'equipmentStatus'
			//, 'inventory', 'location', 'room',
		]);
		
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
		
		$dataProvider->sort->attributes['equipment'] = [
			// The tables are the ones our relation are configured to
			// in my case they are prefixed with "tbl_"
			'asc' => ['equipment.serial_number' => SORT_ASC],
			'desc' => ['equipment.serial_number' => SORT_DESC],
		];				
		
		$dataProvider->sort->attributes['equipmentStatus'] = [
			// The tables are the ones our relation are configured to
			// in my case they are prefixed with "tbl_"
			'asc' => ['equipment_status.status' => SORT_ASC],
			'desc' => ['equipment_status.status' => SORT_DESC],
		];
		
		
		
		
		//, 'equipmentType', 'inventory', 'location', 'room',
		$dataProvider->sort->attributes['equipmentType'] = [
			// The tables are the ones our relation are configured to
			// in my case they are prefixed with "tbl_"
			'asc' => ['equipment_type.name' => SORT_ASC],
			'desc' => ['equipment_type.name' => SORT_DESC],
		];				
		
		/* $dataProvider->sort->attributes['equipment'] = [
			// The tables are the ones our relation are configured to
			// in my case they are prefixed with "tbl_"
			'asc' => ['equipment.serial_number' => SORT_ASC],
			'desc' => ['equipment.serial_number' => SORT_DESC],
		];				
		
		$dataProvider->sort->attributes['equipment'] = [
			// The tables are the ones our relation are configured to
			// in my case they are prefixed with "tbl_"
			'asc' => ['equipment.serial_number' => SORT_ASC],
			'desc' => ['equipment.serial_number' => SORT_DESC],
		];				
		
		$dataProvider->sort->attributes['equipment'] = [
			// The tables are the ones our relation are configured to
			// in my case they are prefixed with "tbl_"
			'asc' => ['equipment.serial_number' => SORT_ASC],
			'desc' => ['equipment.serial_number' => SORT_DESC],
		];	 */			
		
		
		
		
		

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            //'user_id' => $this->user_id,
            'date' => $this->date,
            //'log_type_id' => $this->log_type_id,
            //'equipment_id' => $this->equipment_id,
            'room_id' => $this->room_id,
            //'equipment_status_id' => $this->equipment_status_id,
        ]);

        $query->andFilterWhere(['like', 'equipment_type.name', $this->equipmentType])
			->andFilterWhere(['like', 'user.name', $this->user])
			->andFilterWhere(['like', 'log_type.type', $this->logType])
			->andFilterWhere(['like', 'equipment.serial_number', $this->equipment])			
			->andFilterWhere(['like', 'equipment_status.status', $this->equipmentStatus])			
            ->andFilterWhere(['like', 'inventory', $this->inventory])
            ->andFilterWhere(['like', 'location', $this->location]);

        return $dataProvider;
    }
}

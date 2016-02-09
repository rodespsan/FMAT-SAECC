<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Equipment;

/**
 * EquipmentSearch represents the model behind the search form about `app\models\Equipment`.
 */
class EquipmentSearch extends Equipment
{
	public $equipmentStatus;
	public $room;
	public $location;
	public $equipmentType;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'available'], 'integer'],
            [['inventory', 'description', 'serial_number', 'equipmentType', 'equipmentStatus', 'room', 'location'], 'safe'],
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
        $query = Equipment::find();
		$query->joinWith(['equipmentStatus', 'room', 'location', 'equipmentType']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		
		$dataProvider->sort->attributes['equipmentStatus'] = [
			// The tables are the ones our relation are configured to
			// in my case they are prefixed with "tbl_"
			'asc' => ['equipment_status.status' => SORT_ASC],
			'desc' => ['equipment_status.status' => SORT_DESC],
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
		
		$dataProvider->sort->attributes['equipmentType'] = [
			// The tables are the ones our relation are configured to
			// in my case they are prefixed with "tbl_"
			'asc' => ['equipment_type.name' => SORT_ASC],
			'desc' => ['equipment_type.name' => SORT_DESC],
		];

        $this->load($params);

		if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        /* if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        } */

        $query->andFilterWhere([
            'id' => $this->id,
			'equipment.available' => $this->available,
            //'equipment_type_id' => $this->equipment_type_id,
            //'equipment_status_id' => $this->equipment_status_id,
            //'room_id' => $this->room_id,
            //'location_id' => $this->location_id,            
        ]);

        $query->andFilterWhere(['like', 'inventory', $this->inventory])
			->andFilterWhere(['like', 'equipment_status.status', $this->equipmentStatus])
			->andFilterWhere(['like', 'room.name', $this->room])
			->andFilterWhere(['like', 'location.location', $this->location])
			->andFilterWhere(['like', 'equipment_type.name', $this->equipmentType])	
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'serial_number', $this->serial_number]);

        return $dataProvider;
    }
}

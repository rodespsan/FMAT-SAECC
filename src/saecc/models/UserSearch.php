<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'active'], 'integer'],            
			[['user_name', 'name', 'password_hash', 'auth_key', 'access_token', 'rol'], 'safe'],
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
        $query = User::find();
		//$query->joinWith(['rol']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		
		/* $dataProvider->sort->attributes['rol'] = [
			// The tables are the ones our relation are configured to
			// in my case they are prefixed with "tbl_"
			'asc' => ['auth_assignment.item_name' => SORT_ASC],
			'desc' => ['auth_assignment.item_name' => SORT_DESC],
		]; */

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
			'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'user_name', $this->user_name])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
			->andFilterWhere(['like', 'rol', $this->rol])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
			//->andFilterWhere(['like', 'auth_assignment.item_name', $this->rol])
            ->andFilterWhere(['like', 'access_token', $this->access_token]);

        return $dataProvider;
    }
}

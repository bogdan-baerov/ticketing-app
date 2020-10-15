<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Interventions;

/**
 * InterventionsSearch represents the model behind the search form of `backend\models\Interventions`.
 */
class InterventionsSearch extends Interventions
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['id', 'id_ticket', 'id_user', 'duration'], 'integer'],
            // [['observation', 'intervention', 'date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Interventions::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_ticket' => $this->id_ticket,
            'id_user' => $this->id_user,
        //     'date' => $this->date,
        //     'duration' => $this->duration,
        ]);

        // $query->andFilterWhere(['like', 'observation', $this->observation])
        //     ->andFilterWhere(['like', 'intervention', $this->intervention]);

        return $dataProvider;
    }
}

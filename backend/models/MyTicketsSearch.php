<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Tickets;

/**
 * TicketsSearch represents the model behind the search form of `backend\models\Tickets`.
 */
class MyTicketsSearch extends Tickets
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_user', 'id_it_user', 'ip_address', 'priority', 'location', 'problem', 'status'], 'safe'],
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
        $query = Tickets::find()->where(['id_it_user' => Yii::$app->user->id])->andWhere(['status' => 'În curs']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');    
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            // 'id_user' => $this->id_user,
            // 'ip_address' => $this->ip_address,
            // 'priority' => $this->priority,
            // 'location' => $this->location,
            // 'problem' => $this->problem,
            // 'status' => $this->status
        ]);

        $query->andFilterWhere(['like', 'id_user', $this->id_user])
            ->andFilterWhere(['like', 'ip_address', $this->ip_address])
            ->andFilterWhere(['like', 'priority', $this->priority])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'problem', $this->problem])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}

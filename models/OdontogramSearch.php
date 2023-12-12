<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Odontogram;

/**
 * OdontogramSearch represents the model behind the search form of `app\models\Odontogram`.
 */
class OdontogramSearch extends Odontogram
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rm_gigi_id', 'gigi_id', 'status_gigi_id'], 'integer'],
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
        $query = Odontogram::find();

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
            'rm_gigi_id' => $this->rm_gigi_id,
            'gigi_id' => $this->gigi_id,
            'status_gigi_id' => $this->status_gigi_id,
        ]);

        return $dataProvider;
    }
}

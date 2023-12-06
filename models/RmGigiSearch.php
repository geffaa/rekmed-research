<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RmGigi;

/**
 * RmGigiSearch represents the model behind the search form of `app\models\RmGigi`.
 */
class RmGigiSearch extends RmGigi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rm_gigi_id', 'rm_id'], 'integer'],
            [['oklusi', 'torus_palatinus', 'torus_mandibularis', 'palatum', 'supernumerary_teeth', 'diastema', 'gigi_anomali', 'lain_lain'], 'safe'],
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
        $query = RmGigi::find();

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
            'rm_id' => $this->rm_id,
        ]);

        $query->andFilterWhere(['like', 'oklusi', $this->oklusi])
            ->andFilterWhere(['like', 'torus_palatinus', $this->torus_palatinus])
            ->andFilterWhere(['like', 'torus_mandibularis', $this->torus_mandibularis])
            ->andFilterWhere(['like', 'palatum', $this->palatum])
            ->andFilterWhere(['like', 'supernumerary_teeth', $this->supernumerary_teeth])
            ->andFilterWhere(['like', 'diastema', $this->diastema])
            ->andFilterWhere(['like', 'gigi_anomali', $this->gigi_anomali])
            ->andFilterWhere(['like', 'lain_lain', $this->lain_lain]);

        return $dataProvider;
    }
}

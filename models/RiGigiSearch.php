<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RiGigi;

/**
 * RiGigiSearch represents the model behind the search form of `app\models\RiGigi`.
 */
class RiGigiSearch extends RiGigi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ri_gigi_id', 'rm_gigi_id', 'user_id', 'is_verified'], 'integer'],
            [['tanggal', 'gigi', 'keluhan_diagnosa', 'perawatan'], 'safe'],
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
        $query = RiGigi::find();

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
            'ri_gigi_id' => $this->ri_gigi_id,
            'rm_gigi_id' => $this->rm_gigi_id,
            'tanggal' => $this->tanggal,
            'user_id' => $this->user_id,
            'is_verified' => $this->is_verified,
        ]);

        $query->andFilterWhere(['like', 'gigi', $this->gigi])
            ->andFilterWhere(['like', 'keluhan_diagnosa', $this->keluhan_diagnosa])
            ->andFilterWhere(['like', 'perawatan', $this->perawatan]);

        return $dataProvider;
    }
    public function getDataProviderByRmGigiId($rm_gigi_id)
    {
        $query = RiGigi::find()->where(['rm_gigi_id' => $rm_gigi_id]);
    
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
    
        return $dataProvider;
    }
    
}

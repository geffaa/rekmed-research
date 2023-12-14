<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RiRecord;

/**
 * RiRecordSearch represents the model behind the search form of `app\models\RiRecord`.
 */
class RiRecordSearch extends RiRecord
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ri_record_id', 'rawat_inap_id', 'is_verified', 'is_removed', 'user_id'], 'integer'],
            [['tanggal', 'subjective', 'objective', 'assessment', 'plan'], 'safe'],
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
        $query = RiRecord::find();

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
            'ri_record_id' => $this->ri_record_id,
            'rawat_inap_id' => $this->rawat_inap_id,
            'tanggal' => $this->tanggal,
            'is_verified' => $this->is_verified,
            'is_removed' => $this->is_removed,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'subjective', $this->subjective])
            ->andFilterWhere(['like', 'objective', $this->objective])
            ->andFilterWhere(['like', 'assessment', $this->assessment])
            ->andFilterWhere(['like', 'plan', $this->plan]);

        return $dataProvider;
    }
    public function getDataProviderByRawatInapId($rawat_inap_id)
    {
        $query = RiRecord::find()->where(['rawat_inap_id' => $rawat_inap_id]);
    
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
    
        return $dataProvider;
    }
}

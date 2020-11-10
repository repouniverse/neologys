<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CarrerasTest;

/**
 * CarrerasTestSearch represents the model behind the search form of `common\models\CarrerasTest`.
 */
class CarrerasTestSearch extends CarrerasTest
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'universidad_id', 'facultad_id', 'ciclo'], 'integer'],
            [['codesp', 'nombre', 'acronimo', 'detalle', 'esbase'], 'safe'],
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
        $query = CarrerasTest::find();

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
            'universidad_id' => $this->universidad_id,
            'facultad_id' => $this->facultad_id,
            'ciclo' => $this->ciclo,
        ]);

        $query->andFilterWhere(['like', 'codesp', $this->codesp])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'acronimo', $this->acronimo])
            ->andFilterWhere(['like', 'detalle', $this->detalle])
            ->andFilterWhere(['like', 'esbase', $this->esbase]);

        return $dataProvider;
    }
}

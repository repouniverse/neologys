<?php

namespace frontend\modules\inter\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\inter\models\InterPrograma;

/**
 * InterProgramaSearch represents the model behind the search form of `frontend\modules\inter\models\InterPrograma`.
 */
class InterProgramaSearch extends InterPrograma
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'universidad_id'], 'integer'],
            [['facultad_id', 'codperiodo', 'depa_id', 'clase', 'fopen', 'descripcion', 'detalles'], 'safe'],
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
        $query = InterPrograma::find();

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
            //'programa_id' => $this->programa_id,
        ]);

        $query->andFilterWhere(['like', 'facultad_id', $this->facultad_id])
            ->andFilterWhere(['like', 'codperiodo', $this->codperiodo])
            ->andFilterWhere(['like', 'depa_id', $this->depa_id])
            ->andFilterWhere(['like', 'clase', $this->clase])
            ->andFilterWhere(['like', 'fopen', $this->fopen])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'detalles', $this->detalles]);

        return $dataProvider;
    }
}

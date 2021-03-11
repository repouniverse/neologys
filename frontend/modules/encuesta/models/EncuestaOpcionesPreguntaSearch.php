<?php

namespace frontend\modules\encuesta\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\encuesta\models\EncuestaOpcionesPregunta;

/**
 * EncuestaOpcionesPreguntaSearch represents the model behind the search form of `frontend\modules\encuesta\models\EncuestaOpcionesPregunta`.
 */
class EncuestaOpcionesPreguntaSearch extends EncuestaOpcionesPregunta
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_pregunta'], 'integer'],
            [['valor', 'descripcion'], 'safe'],
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
        $query = EncuestaOpcionesPregunta::find();

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
            'id_pregunta' => $this->id_pregunta,
        ]);

        $query->andFilterWhere(['like', 'valor', $this->valor])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}

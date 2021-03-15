<?php

namespace frontend\modules\encuesta\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\encuesta\models\EncuestaTipoPregunta;

/**
 * EncuestaTipoPreguntaSearch represents the model behind the search form of `frontend\modules\encuesta\models\EncuestaTipoPregunta`.
 */
class EncuestaTipoPreguntaSearch extends EncuestaTipoPregunta
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nombre_tipo'], 'safe'],
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
        $query = EncuestaTipoPregunta::find();

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
        ]);

        $query->andFilterWhere(['like', 'nombre_tipo', $this->nombre_tipo]);

        return $dataProvider;
    }
}

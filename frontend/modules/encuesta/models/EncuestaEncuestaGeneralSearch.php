<?php

namespace frontend\modules\encuesta\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\encuesta\models\EncuestaEncuestaGeneral;

/**
 * EncuestaEncuestaGeneralSearch represents the model behind the search form of `frontend\modules\encuesta\models\EncuestaEncuestaGeneral`.
 */
class EncuestaEncuestaGeneralSearch extends EncuestaEncuestaGeneral
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_tipo_encuesta', 'id_dep_encargado'], 'integer'],
            [['titulo_encuesta', 'id_tipo_usuario', 'descripcion', 'numero_preguntas'], 'safe'],
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
        $query = EncuestaEncuestaGeneral::find();

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
            'id_tipo_encuesta' => $this->id_tipo_encuesta,
            'id_dep_encargado' => $this->id_dep_encargado,
        ]);

        $query->andFilterWhere(['like', 'titulo_encuesta', $this->titulo_encuesta])
            ->andFilterWhere(['like', 'id_tipo_usuario', $this->id_tipo_usuario])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'numero_preguntas', $this->numero_preguntas]);

        return $dataProvider;
    }
}

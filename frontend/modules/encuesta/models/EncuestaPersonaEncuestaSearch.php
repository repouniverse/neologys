<?php

namespace frontend\modules\encuesta\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\encuesta\models\EncuestaPersonaEncuesta;

/**
 * EncuestaPersonaEncuestaSearch represents the model behind the search form of `frontend\modules\encuesta\models\EncuestaPersonaEncuesta`.
 */
class EncuestaPersonaEncuestaSearch extends EncuestaPersonaEncuesta
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_encuesta', 'id_persona'], 'integer'],
            [['fecha'], 'safe'],
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
        $query = EncuestaPersonaEncuesta::find();

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
            'id_encuesta' => $this->id_encuesta,
            'id_persona' => $this->id_persona,
        ]);

        $query->andFilterWhere(['like', 'fecha', $this->fecha]);

        return $dataProvider;
    }
}

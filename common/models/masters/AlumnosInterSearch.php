<?php

namespace common\models\masters;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\masters\AlumnosInter;

/**
 * AlumnosInterSearch represents the model behind the search form of `common\models\masters\AlumnosInter`.
 */
class AlumnosInterSearch extends AlumnosInter
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'facultad_id', 'universidad_id', 'persona_id', 'carrera_id'], 'integer'],
            [['codalu', 'codalu1', 'codalu2', 'codigoper', 'ap', 'am', 'nombres', 'codpering', 'codfac', 'codesp', 'numerodoc', 'tipodoc', 'mail', 'motivo'], 'safe'],
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
        $query = AlumnosInter::find();

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
            'facultad_id' => $this->facultad_id,
            'universidad_id' => $this->universidad_id,
            'persona_id' => $this->persona_id,
            'carrera_id' => $this->carrera_id,
        ]);

        $query->andFilterWhere(['like', 'codalu', $this->codalu])
            ->andFilterWhere(['like', 'codalu1', $this->codalu1])
            ->andFilterWhere(['like', 'codalu2', $this->codalu2])
            ->andFilterWhere(['like', 'codigoper', $this->codigoper])
            ->andFilterWhere(['like', 'ap', $this->ap])
            ->andFilterWhere(['like', 'am', $this->am])
            ->andFilterWhere(['like', 'nombres', $this->nombres])
            ->andFilterWhere(['like', 'codpering', $this->codpering])
            ->andFilterWhere(['like', 'codfac', $this->codfac])
            ->andFilterWhere(['like', 'codesp', $this->codesp])
            ->andFilterWhere(['like', 'numerodoc', $this->numerodoc])
            ->andFilterWhere(['like', 'tipodoc', $this->tipodoc])
            ->andFilterWhere(['like', 'mail', $this->mail])
            ->andFilterWhere(['like', 'motivo', $this->motivo]);

        return $dataProvider;
    }
}

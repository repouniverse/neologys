<?php

namespace frontend\modules\inter\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\inter\models\InterConvocados;
/**
 * InterConvocadosSearch represents the model behind the search form of `frontend\modules\inter\models\InterConvocados`.
 */
class InterConvocadosSearch extends InterConvocados
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'universidad_id', 'facultad_id', 'depa_id', 'modo_id', 'programa_id', 'secuencia', 'alumno_id', 'docente_id', 'persona_id', 'identidad_id'], 'integer'],
            [['codperiodo', 'codocu', 'clase', 'status', 'codalu', 'codigo1', 'codigo2','current_etapa'], 'safe'],            
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
        $query = InterConvocados::find();

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
            'depa_id' => $this->depa_id,
            'modo_id' => $this->modo_id,
            'programa_id' => $this->programa_id,
            'secuencia' => $this->secuencia,
            'alumno_id' => $this->alumno_id,
            'docente_id' => $this->docente_id,
            'persona_id' => $this->persona_id,
            'identidad_id' => $this->identidad_id,
             'current_etapa' => $this->current_etapa,
        ]);

        $query->andFilterWhere(['like', 'codperiodo', $this->codperiodo])
            ->andFilterWhere(['like', 'codocu', $this->codocu])
            ->andFilterWhere(['like', 'clase', $this->clase])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'codalu', $this->codalu])
            ->andFilterWhere(['like', 'codigo1', $this->codigo1])
            ->andFilterWhere(['like', 'codigo2', $this->codigo2]);

        return $dataProvider;
    }
}
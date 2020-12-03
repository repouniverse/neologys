<?php

namespace frontend\modules\acad\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\acad\models\AcadSyllabus;

/**
 * AcadSyllabusSearch represents the model behind the search form of `frontend\modules\acad\models\AcadSyllabus`.
 */
class AcadSyllabusSearch extends AcadSyllabus
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'plan_id', 'curso_id', 'n_horasindep', 'docente_owner_id', 'formula_id'], 'integer'],
            [['codperiodo', 'datos_generales', 'sumilla', 'competencias', 'prog_contenidos', 'estrat_metod', 'recursos_didac', 'fuentes_info', 'reserva1', 'reserva2'], 'safe'],
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
        $query = AcadSyllabus::find();

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
            'plan_id' => $this->plan_id,
            'curso_id' => $this->curso_id,
            'n_horasindep' => $this->n_horasindep,
            'docente_owner_id' => $this->docente_owner_id,
            'formula_id' => $this->formula_id,
        ]);

        $query->andFilterWhere(['like', 'codperiodo', $this->codperiodo])
            ->andFilterWhere(['like', 'datos_generales', $this->datos_generales])
            ->andFilterWhere(['like', 'sumilla', $this->sumilla])
            ->andFilterWhere(['like', 'competencias', $this->competencias])
            ->andFilterWhere(['like', 'prog_contenidos', $this->prog_contenidos])
            ->andFilterWhere(['like', 'estrat_metod', $this->estrat_metod])
            ->andFilterWhere(['like', 'recursos_didac', $this->recursos_didac])
            ->andFilterWhere(['like', 'fuentes_info', $this->fuentes_info])
            ->andFilterWhere(['like', 'reserva1', $this->reserva1])
            ->andFilterWhere(['like', 'reserva2', $this->reserva2]);

        return $dataProvider;
    }
}

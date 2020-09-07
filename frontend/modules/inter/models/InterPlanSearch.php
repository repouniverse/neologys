<?php

namespace frontend\modules\inter\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\inter\models\InterPlan;

/**
 * InterExpedientesSearch represents the model behind the search form of `frontend\modules\inter\models\InterExpedientes`.
 */
class InterPlanSearch extends InterPlan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'universidad_id', 'facultad_id', 'depa_id', 'programa_id', 'modo_id'], 'integer'],
            [['id', 'universidad_id', 'facultad_id', 'depa_id', 'programa_id', 'modo_id', 'orden', 'etapa_id', 'ordenetapa'], 'safe'],
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
        $query = InterPlan::find();

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
             'eval_id' => $this->eval_id,
            'programa_id' => $this->programa_id,
            'modo_id' => $this->modo_id,
            'etapa_id' => $this->etapa_id,
        ]);

        $query->andFilterWhere(['like', 'descripcion', $this->descripcion])
            /*->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'codocu', $this->codocu])*/
            /*->andFilterWhere(['like', 'fpresenta', $this->fpresenta])
            ->andFilterWhere(['like', 'fdocu', $this->fdocu])
            ->andFilterWhere(['like', 'detalles', $this->detalles])
            ->andFilterWhere(['like', 'textointerno', $this->textointerno])
            ->andFilterWhere(['like', 'estado', $this->estado])
            ->andFilterWhere(['like', 'requerido', $this->requerido])*/;

        return $dataProvider;
    }
}

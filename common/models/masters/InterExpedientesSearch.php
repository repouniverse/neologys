<?php

namespace common\models\masters;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\inter\models\InterExpedientes;

/**
 * InterExpedientesSearch represents the model behind the search form of `frontend\modules\inter\models\InterExpedientes`.
 */
class InterExpedientesSearch extends InterExpedientes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'universidad_id', 'facultad_id', 'depa_id', 'programa_id', 'modo_id', 'convocado_id'], 'integer'],
            [['clase', 'status', 'codocu', 'fpresenta', 'fdocu', 'detalles', 'textointerno', 'estado', 'requerido'], 'safe'],
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
        $query = InterExpedientes::find();

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
            'programa_id' => $this->programa_id,
            'modo_id' => $this->modo_id,
            'convocado_id' => $this->convocado_id,
        ]);

        $query->andFilterWhere(['like', 'clase', $this->clase])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'codocu', $this->codocu])
            ->andFilterWhere(['like', 'fpresenta', $this->fpresenta])
            ->andFilterWhere(['like', 'fdocu', $this->fdocu])
            ->andFilterWhere(['like', 'detalles', $this->detalles])
            ->andFilterWhere(['like', 'textointerno', $this->textointerno])
            ->andFilterWhere(['like', 'estado', $this->estado])
            ->andFilterWhere(['like', 'requerido', $this->requerido]);

        return $dataProvider;
    }
}

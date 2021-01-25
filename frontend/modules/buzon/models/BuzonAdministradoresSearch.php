<?php

namespace frontend\modules\buzon\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\buzon\models\BuzonAdministradores;

/**
 * BuzonAdministradoresSearch represents the model behind the search form of `frontend\modules\buzon\models\BuzonAdministradores`.
 */
class BuzonAdministradoresSearch extends BuzonAdministradores
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'persona_id', 'departamento_id'], 'integer'],
            [['activo'], 'safe'],
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
        $query = BuzonAdministradores::find();

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
            'persona_id' => $this->persona_id,
            'departamento_id' => $this->departamento_id,
        ]);

        $query->andFilterWhere(['like', 'activo', $this->activo]);

        return $dataProvider;
    }
}

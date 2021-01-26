<?php

namespace frontend\modules\buzon\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\buzon\models\BuzonAulaVirt;

/**
 * BuzonAdministradoresSearch represents the model behind the search form of `frontend\modules\buzon\models\BuzonAdministradores`.
 */
class BuzonAulaVirtSearch extends BuzonAulaVirt
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'bm_id'], 'integer'],
            [['docente', 'curso', 'seccion', 'ciclo'], 'safe'],
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
        $query = BuzonAulaVirt::find();

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
            'bm_id' => $this->bm_id,
        ]);

        $query->andFilterWhere(['like', 'docente', $this->docente])
            ->andFilterWhere(['like', 'curso', $this->curso])
            ->andFilterWhere(['like', 'seccion', $this->seccion])
            ->andFilterWhere(['like', 'ciclo', $this->ciclo]);

        return $dataProvider;
    }
}

<?php

namespace common\models\masters;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\masters\Tenores;

/**
 * TenoresSearch represents the model behind the search form of `common\models\masters\Tenores`.
 */
class TenoresSearch extends Tenores
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'universidad_id', 'facultad_id', 'order'], 'integer'],
            [['codocu', 'activo', 'idioma', 'posic', 'texto'], 'safe'],
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
        $query = Tenores::find();

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
            'order' => $this->order,
        ]);

        $query->andFilterWhere(['like', 'codocu', $this->codocu])
            ->andFilterWhere(['like', 'activo', $this->activo])
            ->andFilterWhere(['like', 'idioma', $this->idioma])
            ->andFilterWhere(['like', 'posic', $this->posic])
            ->andFilterWhere(['like', 'texto', $this->texto]);

        return $dataProvider;
    }
}

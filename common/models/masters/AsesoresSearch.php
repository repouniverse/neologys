<?php

namespace common\models\masters;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\masters\Asesores;

/**
 * AsesoresSearch represents the model behind the search form of `common\models\masters\Asesores`.
 */
class AsesoresSearch extends Asesores
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'persona_id'], 'integer'],
            [['orcid', 'activo'], 'safe'],
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
        $query = Asesores::find();

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
        ]);

        $query->andFilterWhere(['like', 'orcid', $this->orcid])
            ->andFilterWhere(['like', 'activo', $this->activo]);

        return $dataProvider;
    }
}

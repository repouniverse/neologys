<?php

namespace common\models\masters;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\masters\Combovalores;

/**
 * CombovaloresSearch represents the model behind the search form of `common\models\masters\Combovalores`.
 */
class CombovaloresSearch extends Combovalores
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nombretabla', 'codcen', 'codigo', 'valor', 'valor1', 'valor2'], 'safe'],
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
        $query = Combovalores::find();

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
        ]);

        $query->andFilterWhere(['like', 'nombretabla', $this->nombretabla])
            ->andFilterWhere(['like', 'codcen', $this->codcen])
            ->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['like', 'valor', $this->valor])
            ->andFilterWhere(['like', 'valor1', $this->valor1])
            ->andFilterWhere(['like', 'valor2', $this->valor2]);

        return $dataProvider;
    }
}

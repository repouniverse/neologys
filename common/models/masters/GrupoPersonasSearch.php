<?php

namespace common\models\masters;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\masters\GrupoPersonas;

/**
 * GrupoParametrosSearch represents the model behind the search form of `common\models\masters\GrupoParametros`.
 */
class GrupoPersonasSearch extends GrupoPersonas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           
            [['codgrupo', 'desgrupo', 'modelo'], 'safe'],
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
        $query = GrupoPersonas::find();

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
       

        $query->andFilterWhere(['like', 'codgrupo', $this->codgrupo])
            ->andFilterWhere(['like', 'desgrupo', $this->desgrupo])
            ->andFilterWhere(['like', 'modelo', $this->modelo]);

        return $dataProvider;
    }
}

<?php

namespace common\models\masters;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\masters\Combovalores;

/**
 * CombovaloresSearch represents the model behind the search form of `common\models\masters\Combovalores`.
 */
class DocentesSearch extends Docentes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [           
            [['ap','am','nombres','codoce', 'tipodoc', 'numerodoc'], 'safe'],
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
        $query = Docentes::find();

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

        $query->andFilterWhere(['like', 'ap', $this->ap])
              ->andFilterWhere(['like', 'am', $this->am])
              ->andFilterWhere(['tipodoc'=>$this->tipodoc])
              ->andFilterWhere(['like', 'nombres', $this->nombres])
              ->andFilterWhere(['like', 'codoce', $this->codoce])
              ->andFilterWhere(['like', 'numerodoc', $this->numerodoc]);

        return $dataProvider;
    }
}

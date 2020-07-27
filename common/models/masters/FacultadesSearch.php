<?php

namespace common\models\masters;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\masters\Facultades;

/**
 * GrupoParametrosSearch represents the model behind the search form of `common\models\masters\GrupoParametros`.
 */
class FacultadesSearch extends Facultades
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            
            [['codfac', 'desfac'], 'safe'],
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
        $query = Facultades::find();

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

       

        $query->andFilterWhere(['like', 'desfac', $this->desfac])
           ;

        return $dataProvider;
    }
}

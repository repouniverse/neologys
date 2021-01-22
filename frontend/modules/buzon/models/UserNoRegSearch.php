<?php

namespace frontend\modules\buzon\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\buzon\models\UserNoReg;

/**
 * UserNoRegSearch represents the model behind the search form of `frontend\modules\buzon\models\UserNoReg`.
 */
class UserNoRegSearch extends UserNoReg
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nombre', 'ap', 'am', 'dni', 'email', 'celular'], 'safe'],
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
        $query = UserNoReg::find();

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

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'ap', $this->ap])
            ->andFilterWhere(['like', 'am', $this->am])
            ->andFilterWhere(['like', 'dni', $this->dni])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'celular', $this->celular]);

        return $dataProvider;
    }
}

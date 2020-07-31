<?php

namespace frontend\modules\import\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\import\models\ImportCargamasiva;

/**
 * ImportCargamasivaSearch represents the model behind the search form of `frontend\modules\import\models\ImportCargamasiva`.
 */
class ImportCargamasivaSearch extends ImportCargamasiva
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['insercion', 'escenario', 'lastimport', 'descripcion', 'format', 'modelo'], 'safe'],
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
        $query = ImportCargamasiva::find();

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
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'insercion', $this->insercion])
            ->andFilterWhere(['like', 'escenario', $this->escenario])
            ->andFilterWhere(['like', 'lastimport', $this->lastimport])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'format', $this->format])
            ->andFilterWhere(['like', 'modelo', $this->modelo]);

        return $dataProvider;
    }
}

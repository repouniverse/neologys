<?php

namespace frontend\modules\buzon\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\buzon\models\BuzonMensajes;

/**
 * BuzonMensajesSearch represents the model behind the search form of `frontend\modules\buzon\models\BuzonMensajes`.
 */
class BuzonVwMensajesSearch extends BuzonVwMensajes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'departamento_id'], 'integer'],
            [['mensaje', 'estado', 'prioridad', 'fecha_registro'], 'safe'],
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
        $query = BuzonMensajes::find();

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
            'departamento_id' => $this->departamento_id,
            'fecha_registro' => $this->fecha_registro,
        ]);

        $query->andFilterWhere(['like', 'mensaje', $this->mensaje])
            ->andFilterWhere(['like', 'estado', $this->estado])
            ->andFilterWhere(['like', 'prioridad', $this->prioridad]);

        return $dataProvider;
    }
}
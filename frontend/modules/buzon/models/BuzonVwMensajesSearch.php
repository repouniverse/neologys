<?php

namespace frontend\modules\buzon\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\buzon\models\BuzonVwMensajes;

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
             
            [['id','user_id','nombres','departamento_id','ap', 'am','codesp','numerodoc','email', 'nombredepa', 'mensaje','estado','fecha_registro','prioridad'], 'safe'],
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
        $query = BuzonVwMensajes::find();

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
            'departamento_id' => $this->departamento_id,
          
        ]);
        
        $query->andFilterWhere(['like', 'nombres', $this->nombres])
            ->andFilterWhere(['like', 'ap', $this->ap])
            ->andFilterWhere(['like', 'am', $this->am])
            ->andFilterWhere(['like', 'codesp', $this->codesp])
            ->andFilterWhere(['like', 'numerodoc', $this->numerodoc])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'nombredepa', $this->nombredepa])
            ->andFilterWhere(['like', 'mensaje', $this->mensaje])
            ->andFilterWhere(['like', 'estado', $this->estado])
            ->andFilterWhere(['like', 'fecha_registro', $this->fecha_registro])
            ->andFilterWhere(['like', 'prioridad', $this->prioridad]);

        return $dataProvider;
    }
}
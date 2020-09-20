<?php

namespace frontend\modules\inter\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\inter\models\InterEventos;
/**
 * InterConvocadosSearch represents the model behind the search form of `frontend\modules\inter\models\InterConvocados`.
 */
class InterEventosSearch extends InterEventos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'universidad_id', 'facultad_id'], 'integer'],
            [['universidad_id', 'facultad_id','web','numero','descripcion','finicio','finicio1'], 'safe'],            
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
        $query = InterEventos::find();

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
            //'id' => $this->id,
            'universidad_id' => $this->universidad_id,
            'facultad_id' => $this->facultad_id,
            
        ]);

        $query->andFilterWhere(['like', 'numero', $this->numero])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'ciudad', $this->ciudad])
           ;
        if(!empty($this->finicio) && !empty($this->finicio1)){
         $query->andFilterWhere([
             'between',
             'finicio',
             $this->openBorder('finicio',false),
             $this->openBorder('finicio1',true)
                        ]);   
        }
       // echo $query->createCommand()->getRawSql();die();
        return $dataProvider;
    }
}
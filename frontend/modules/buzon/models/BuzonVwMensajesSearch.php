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

            [[

                'user_id',
                'departamento_id',
                'trabajador_id',
                'carrera_id',
                'buzon_mensaje_id',
                'alumno_nombres',
                'trabajador_nombres',
                'alumno_ap',
                'alumno_am',
                'trabajador_ap',
                'trabajador_am',
                'codesp',
                'numerodoc',
                'mail',
                'nombredepa',
                'mensaje',
                'estado',
                'fecha_registro',
                'prioridad',
            ], 'safe'],
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
            'buzon_mensaje_id' => $this->buzon_mensaje_id,
            'user_id' => $this->user_id,
            'departamento_id' => $this->departamento_id,
            'trabajador_id' => $this->trabajador_id,
            'carrera_id' => $this->carrera_id,

        ]);

        $query->andFilterWhere(['like', 'alumno_nombres', $this->alumno_nombres])
            ->andFilterWhere(['like', 'trabajador_nombres', $this->trabajador_nombres])
            ->andFilterWhere(['like', 'alumno_ap', $this->alumno_ap])
            ->andFilterWhere(['like', 'alumno_am', $this->alumno_am])
            ->andFilterWhere(['like', 'trabajador_ap', $this->trabajador_ap])
            ->andFilterWhere(['like', 'trabajador_am', $this->trabajador_am])
            ->andFilterWhere(['like', 'codesp', $this->codesp])
            ->andFilterWhere(['like', 'numerodoc', $this->numerodoc])
            ->andFilterWhere(['like', 'mail', $this->mail])
            ->andFilterWhere(['like', 'nombredepa', $this->nombredepa])
            ->andFilterWhere(['like', 'estado', $this->estado])
            ->andFilterWhere(['like', 'fecha_registro', $this->fecha_registro])
            ->andFilterWhere(['like', 'prioridad', $this->prioridad])
            ->orderBy(['estado' => SORT_ASC]);
        return $dataProvider;
    }
}

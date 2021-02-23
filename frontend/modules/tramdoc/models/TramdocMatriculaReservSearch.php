<?php

namespace frontend\modules\tramdoc\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\tramdoc\models\TramdocMatriculaReserv;

/**
 * TramdocMatriculaReservSearch represents the model behind the search form of `frontend\modules\tramdoc\models\TramdocMatriculaReserv`.
 */
class TramdocMatriculaReservSearch extends TramdocMatriculaReserv
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'carrera_id'], 'integer'],
            [['nro_matr', 'codigo', 'dni', 'apellido_paterno', 'apellido_materno', 'nombres', 'email_usmp', 'email_personal', 'celular', 'telefono', 'mensaje', 'obs_alumno', 'fecha_solicitud', 'fecha_registro', 'cta_sin_deuda_pendiente_check', 'cta_sin_deuda_pendiente_obs', 'cta_pago_tramite_check', 'cta_pago_tramite_adjunto', 'cta_pago_tramite_obs', 'ora_soli_reg_check', 'ora_soli_reg_adjunto', 'ora_soli_reg_obs', 'estado', 'estado_obs'], 'safe'],
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
        $query = TramdocMatriculaReserv::find();

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
            'carrera_id' => $this->carrera_id,
            'fecha_solicitud' => $this->fecha_solicitud,
            'fecha_registro' => $this->fecha_registro,
        ]);

        $query->andFilterWhere(['like', 'nro_matr', $this->nro_matr])
            ->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['like', 'dni', $this->dni])
            ->andFilterWhere(['like', 'apellido_paterno', $this->apellido_paterno])
            ->andFilterWhere(['like', 'apellido_materno', $this->apellido_materno])
            ->andFilterWhere(['like', 'nombres', $this->nombres])
            ->andFilterWhere(['like', 'email_usmp', $this->email_usmp])
            ->andFilterWhere(['like', 'email_personal', $this->email_personal])
            ->andFilterWhere(['like', 'celular', $this->celular])
            ->andFilterWhere(['like', 'telefono', $this->telefono])
            ->andFilterWhere(['like', 'mensaje', $this->mensaje])
            ->andFilterWhere(['like', 'obs_alumno', $this->obs_alumno])
            ->andFilterWhere(['like', 'cta_sin_deuda_pendiente_check', $this->cta_sin_deuda_pendiente_check])
            ->andFilterWhere(['like', 'cta_sin_deuda_pendiente_obs', $this->cta_sin_deuda_pendiente_obs])
            ->andFilterWhere(['like', 'cta_pago_tramite_check', $this->cta_pago_tramite_check])
            ->andFilterWhere(['like', 'cta_pago_tramite_adjunto', $this->cta_pago_tramite_adjunto])
            ->andFilterWhere(['like', 'cta_pago_tramite_obs', $this->cta_pago_tramite_obs])
            ->andFilterWhere(['like', 'ora_soli_reg_check', $this->ora_soli_reg_check])
            ->andFilterWhere(['like', 'ora_soli_reg_adjunto', $this->ora_soli_reg_adjunto])
            ->andFilterWhere(['like', 'ora_soli_reg_obs', $this->ora_soli_reg_obs])
            ->andFilterWhere(['like', 'estado', $this->estado])
            ->andFilterWhere(['like', 'estado_obs', $this->estado_obs]);

        return $dataProvider;
    }
}

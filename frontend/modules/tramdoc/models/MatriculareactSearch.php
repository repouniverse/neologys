<?php

namespace frontend\modules\tramdoc\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\tramdoc\models\Matriculareact;

/**
 * MatriculareactSearch represents the model behind the search form of `frontend\modules\tramdoc\models\Matriculareact`.
 */
class MatriculareactSearch extends Matriculareact
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'carrera_id'], 'integer'],
            [['nro_matr', 'codigo', 'dni', 'apellido_paterno', 'apellido_materno', 'nombres', 'email_usmp', 'email_personal', 'celular', 'telefono', 'mensaje', 'fecha_solicitud', 'fecha_registro', 'cta_sin_deuda_pendiente_check', 'cta_sin_deuda_pendiente_obs', 'cta_pago_tramite_check', 'cta_pago_tramite_adjunto', 'cta_pago_tramite_obs', 'ora_record_notas_check', 'ora_record_notas_adjunto', 'ora_record_notas_obs', 'aca_cursos_aptos_check', 'aca_cursos_aptos_adjunto', 'aca_cursos_aptos_observaciones', 'ora_cursos_aptos_check', 'ora_cursos_aptos_obs', 'oti_cursos_aptos_check', 'oti_cursos_aptos_obs', 'oti_notifica_email_check', 'oti_notifica_email_obs'], 'safe'],
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
        $query = Matriculareact::find();

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
            ->andFilterWhere(['like', 'cta_sin_deuda_pendiente_check', $this->cta_sin_deuda_pendiente_check])
            ->andFilterWhere(['like', 'cta_sin_deuda_pendiente_obs', $this->cta_sin_deuda_pendiente_obs])
            ->andFilterWhere(['like', 'cta_pago_tramite_check', $this->cta_pago_tramite_check])
            ->andFilterWhere(['like', 'cta_pago_tramite_adjunto', $this->cta_pago_tramite_adjunto])
            ->andFilterWhere(['like', 'cta_pago_tramite_obs', $this->cta_pago_tramite_obs])
            ->andFilterWhere(['like', 'ora_record_notas_check', $this->ora_record_notas_check])
            ->andFilterWhere(['like', 'ora_record_notas_adjunto', $this->ora_record_notas_adjunto])
            ->andFilterWhere(['like', 'ora_record_notas_obs', $this->ora_record_notas_obs])
            ->andFilterWhere(['like', 'aca_cursos_aptos_check', $this->aca_cursos_aptos_check])
            ->andFilterWhere(['like', 'aca_cursos_aptos_adjunto', $this->aca_cursos_aptos_adjunto])
            ->andFilterWhere(['like', 'aca_cursos_aptos_observaciones', $this->aca_cursos_aptos_observaciones])
            ->andFilterWhere(['like', 'ora_cursos_aptos_check', $this->ora_cursos_aptos_check])
            ->andFilterWhere(['like', 'ora_cursos_aptos_obs', $this->ora_cursos_aptos_obs])
            ->andFilterWhere(['like', 'oti_cursos_aptos_check', $this->oti_cursos_aptos_check])
            ->andFilterWhere(['like', 'oti_cursos_aptos_obs', $this->oti_cursos_aptos_obs])
            ->andFilterWhere(['like', 'oti_notifica_email_check', $this->oti_notifica_email_check])
            ->andFilterWhere(['like', 'oti_notifica_email_obs', $this->oti_notifica_email_obs])

            ->andFilterWhere(['like', 'fecha_solicitud', $this->fecha_solicitud]);

        return $dataProvider;
    }
}

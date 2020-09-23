<?php

namespace frontend\modules\inter\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\inter\models\InterVwExpedientesDocentes;

/**
 * InterConvocadosSearch represents the model behind the search form of `frontend\modules\inter\models\InterConvocados`.
 */
class InterVwExpedientesDocentesSearch extends InterVwExpedientesDocentes
{
       use \common\traits\attachmentTrait;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'universidad_id', 'facultad_id', 'depa_id', 'modo_id', 'programa_id', 'secuencia', 'alumno_id', 'docente_id', 'persona_id', 'identidad_id'], 'integer'],
            [['ap','am','nombres','codgrupo','tipodoc','numerodoc','codperiodo', 'codocu', 'clase', 'status', 'codigodocente', 'codoce1', 'codoce2','current_etapa','facultad_id','carrera_base','facudest_id','unidest_id','carreradest_id'], 'safe'],
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
        $query = InterVwExpedientesDocentes::find();

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
            'universidad_id' => $this->universidad_id,
            'facultad_id' => $this->facultad_id,
            'depa_id' => $this->depa_id,
            'modo_id' => $this->modo_id,
             'carrera_id' => $this->carrera_id,
            'programa_id' => $this->programa_id,
            //'secuencia' => $this->secuencia,
            //'alumno_id' => $this->alumno_id,
            //'docente_id' => $this->docente_id,
            'persona_id' => $this->persona_id,
            'identidad_id' => $this->identidad_id,
              'codperiodo' => $this->codperiodo,
            'codgrupo' => $this->codgrupo,
              'current_etapa' => $this->current_etapa,
        ]);

        $query->andFilterWhere(['like', 'ap', $this->ap])
            ->andFilterWhere(['like', 'am', $this->am])
            ->andFilterWhere(['like', 'nombres', $this->nombres])
            ->andFilterWhere(['like', 'tipodoc', $this->tipodoc])
            ->andFilterWhere(['like', 'codigoper', $this->codigoper])
           ;

        return $dataProvider;
    }
    
     public function searchByPendienteByEvaluador($id_trabajador)
    {
      $idsEvaluaciones= InterEvaluadores::find()->select(['id'])
                 ->andWhere(['trabajador_id'=>$id_trabajador])->column();
         
         
         
        $query = InterVwExpedientesDocentes::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

       // $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_eval'=>$idsEvaluaciones,
            'id_expediente'=>$this->idsInAttachments(InterExpedientes::getShortNameClass()),
           'estadoexp'=>'0' 
        ]);

        

        return $dataProvider;
    }
    
}

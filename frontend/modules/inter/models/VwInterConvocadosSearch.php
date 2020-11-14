<?php

namespace frontend\modules\inter\models;
use common\helpers\h;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\inter\models\InterVwConvocados;

/**
 * InterConvocadosSearch represents the model behind the search form of `frontend\modules\inter\models\InterConvocados`.
 */
class VwInterConvocadosSearch extends InterVwConvocados
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'universidad_id', 'facultad_id', 'depa_id', 'modo_id', 'programa_id', 'secuencia', 'alumno_id', 'docente_id', 'persona_id', 'identidad_id'], 'integer'],
            [['ap','am','nombres','codgrupo','tipodoc','numerodoc','codperiodo', 'codocu', 'clase', 'status', 'codalu', 'codigo1', 'codigo2','current_etapa','codigoalumno','facultad_id','carrera_id','estado','univorigen_id'], 'safe'],
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
        $query = InterVwConvocados::find();

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
            'universidad_id' => h::currentUniversity(),
            'univorigen_id' => $this->univorigen_id,
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
             'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['like', 'ap', $this->ap])
            ->andFilterWhere(['like', 'am', $this->am])
             ->andFilterWhere(['like', 'codigoalumno', $this->codigoalumno])
            ->andFilterWhere(['like', 'nombres', $this->nombres])
            ->andFilterWhere(['like', 'tipodoc', $this->tipodoc])
            ->andFilterWhere(['like', 'codigoper', $this->codigoper])
           ;

        return $dataProvider;
    }
    
 public static function filtroGet($nombrecampo){
     //\yii::error($nombrecampo);
     //\yii::error(h::request()->get(self::getShortNameClass()));
     $arrayGet=h::request()->get(self::getShortNameClass());
     if(!is_null($arrayGet)){
        $filtro=h::request()->get(self::getShortNameClass())[$nombrecampo];
           if(is_null($filtro) or $filtro=='')
           {
              return null;
           }else{
               return $filtro;  
           } 
     }else{
         return null;
     }
     
 }
    
    
}

<?php

namespace frontend\modules\inter\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\inter\models\InterVwPlanes;

/**
 * InterConvocadosSearch represents the model behind the search form of `frontend\modules\inter\models\InterConvocados`.
 */
class InterVwPlanesSearch extends InterVwPlanes
{
    ///use \common\traits\attachmentTrait;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'universidad_id', 'facultad_id', 'depa_id', 'modo_id', 'programa_id',], 'integer'],
            [['id' => $this->id,
            'universidad_id',
            'facultad_id',
            'depa_id',
            'modo_id',
             'carrera_id',
            'programa_id',
             'etapa_id',
             'codocu',
            'codperiodo',
              'ap',
         'descripcion',
          'descrimodo',
              'descrietapa',
           'desdocu', 
           'descrieval',
             'nombredepa',
            'nombrecarrera',
            
                
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
        $query = InterVwPlanes::find();

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
             'etapa_id' => $this->etapa_id,
             'codocu' => $this->codocu,
            'codperiodo' => $this->codperiodo,
            //'secuencia' => $this->secuencia,
           
        ]);

        $query->andFilterWhere(['like', 'ap', $this->ap])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'desdocu', $this->desdocu])
            ->andFilterWhere(['like', 'descrieval', $this->descrieval])
              ->andFilterWhere(['like', 'descrietapa', $this->descrietapa])
            ->andFilterWhere(['like', 'descrimodo', $this->descrimodo])
              ->andFilterWhere(['like', 'nombredepa', $this->nombredepa])
             ->andFilterWhere(['like', 'nombrecarrera', $this->nombrecarrera])
           ;

        return $dataProvider;
    }
    
     public function searchByPendienteByEvaluador($id_trabajador)
    {
       $idsEvaluaciones= InterEvaluadores::find()->select(['id'])
                 ->andWhere(['trabajador_id'=>$id_trabajador])->column();
       //$idsAttachments=$this->idsInAttachments(InterExpedientes::getShortNameClass());
      
        $query = InterVwExpedientes::find();
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

        
///echo $query->createCommand()->rawSql;die();
        return $dataProvider;
    }
    
}

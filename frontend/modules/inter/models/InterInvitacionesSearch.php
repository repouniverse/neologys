<?php

namespace frontend\modules\inter\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\inter\models\InterInvitaciones;
/**
 * InterConvocadosSearch represents the model behind the search form of `frontend\modules\inter\models\InterConvocados`.
 */
class InterInvitacionesSearch extends InterInvitaciones
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'universidad_id', 'facultad_id'], 'integer'],
            [['universidad_id', 'facultad_id','facultad_dest','numero','descripcion','docenteanfi_id','docenteinv_id'], 'safe'],            
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

    public function getDocenteinv()
    {
        return $this->hasOne(\common\models\masters\Docentes::className(), ['id' => 'docenteinv_id']);
    }
     public function getDocenteanfi()
    {
        return $this->hasOne(\common\models\masters\Docentes::className(), ['id' => 'docenteanfi_id']);
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
        $query = InterInvitaciones::find();

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
             'universidad_dest' => $this->universidad_dest,
            'docenteanfi_id' => $this->docenteanfi_id,
            'docenteinv_id' => $this->docenteinv_id,
        ]);

        $query->andFilterWhere(['like', 'numero', $this->numero])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
           ;
        
       // echo $query->createCommand()->getRawSql();die();
        return $dataProvider;
    }
}
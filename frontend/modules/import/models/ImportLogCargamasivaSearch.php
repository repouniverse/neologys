<?php

namespace frontend\modules\import\models;
use common\helpers\h;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\import\models\ImportLogcargamasiva;

/**
 * ImportCargamasivaSearch represents the model behind the search form of `frontend\modules\import\models\ImportCargamasiva`.
 */
class ImportLogCargamasivaSearch extends ImportLogcargamasiva
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['mensaje', 'level', 'numerolinea'], 'safe'],
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
        $query = ImportLogCargamasiva::find();

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
        ]);

        
        return $dataProvider;
    }
    
    
    public function searchByCarga($params,$idcarga)
    {
        $query = ImportLogCargamasiva::find();

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
            'cargamasiva_id' => $idcarga,
            'user_id' => h::userId() ,
        ]);

        
        return $dataProvider;
    }
}

<?php
    namespace common\models\masters;
    use yii\base\Model;
    use yii\data\ActiveDataProvider;

class DocentesSearch extends Docentes
{   
    public function rules()
    {
        return [[['ap','am','nombres','codoce', 'tipodoc', 'numerodoc','universidad_id'], 'safe'],];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Docentes::find();
        $dataProvider = new ActiveDataProvider(['query' => $query,]);
        $this->load($params);
        if (!$this->validate())
        {
            return $dataProvider;
        }
        $query->andFilterWhere(['id' => $this->id,]);
        $query->andFilterWhere(['like', 'ap', $this->ap])
              ->andFilterWhere(['like', 'am', $this->am])
              ->andFilterWhere(['tipodoc'=>$this->tipodoc])
              ->andFilterWhere(['universidad_id'=>$this->universidad_id])
              ->andFilterWhere(['like', 'nombres', $this->nombres])
              ->andFilterWhere(['like', 'codoce', $this->codoce])
              ->andFilterWhere(['like', 'numerodoc', $this->numerodoc]);

        return $dataProvider;
    }
}
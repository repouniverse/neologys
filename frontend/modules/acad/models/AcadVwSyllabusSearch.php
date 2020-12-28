<?php
namespace frontend\modules\acad\models;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\acad\models\AcadVwSyllabusSearch;

/**
 * AcadSyllabusSearch represents the model behind the search form of `frontend\modules\acad\models\AcadSyllabus`.
 */
class AcadVwSyllabusSearch extends AcadVwSyllabus
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['id', 'plan_id', 'curso_id', 'n_horasindep', 'docente_owner_id', 'formula_id'], 'integer'],
            [['codperiodo','codestado', 'descripcion',
                'codcur', 'codcursocorto', 'carrera_id',
                'ap','codesp','am','nombres','codocu'
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
        $query = AcadVwSyllabus::find();

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
            'carrera_id' => $this->carrera_id,
          
        ]);

        $query->andFilterWhere(['like', 'codcur', $this->codcur])
                 ->andFilterWhere(['like', 'codesp', $this->codesp])
            ->andFilterWhere(['like', 'codcursocorto', $this->codcursocorto])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
              ->andFilterWhere(['like', 'ap', $this->ap])
             ->andFilterWhere(['like', 'am', $this->am])
            ->andFilterWhere(['like', 'codperiodo', $this->codperiodo]);

        return $dataProvider;
    }
    
    
}

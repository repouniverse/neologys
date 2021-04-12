<?php

namespace frontend\modules\repositorio\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
//use common\models\masters\AsesoresCurso;

/**
 * AsesoresCursoSearch represents the model behind the search form of `common\models\masters\AsesoresCurso`.
 */
class RepoVwAsesoresAsignadosSearch extends RepoVwAsesoresAsignados
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['nombres','apasesor'], 'string'],
            [['ap', 'am', 'nombres', 'apasesor', 'amasesor', 'seccion', 'descripcion', 'codalu', 'nombresasesor', 'codesp', 'periodo'], 'safe'],
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
        $query = RepoVwAsesoresAsignados::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        /* if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }*/

        // grid filtering conditions
        $query->andFilterWhere(['like', 'nombres', $this->nombres])->andFilterWhere(['like', 'seccion', $this->seccion])->andFilterWhere(['like', 'descripcion', $this->descripcion])->andFilterWhere(['like', 'codalu', $this->codalu])->andFilterWhere(['like', 'apasesor', $this->apasesor])->andFilterWhere(['like', 'ap', $this->ap])->andFilterWhere(['like', 'am', $this->am])->andFilterWhere(['like', 'amasesor', $this->amasesor])->andFilterWhere(['like', 'nombresasesor', $this->nombresasesor])->andFilterWhere(['like', 'codesp', $this->codesp])->andFilterWhere(['like', 'periodo', $this->periodo])
            ->orderBy([
                'descripcion' => SORT_ASC,
                'apasesor' => SORT_ASC,
                'nombresasesor' => SORT_ASC,
                'ap' => SORT_ASC,
                'am' => SORT_ASC,
                'nombres' => SORT_ASC,
                'periodo' => SORT_ASC,
            ])->all();
        \yii::error($query->createCommand()->rawSql);
        // $query->andFilterWhere(['like', 'activo', $this->activo]);

        return $dataProvider;
    }
}

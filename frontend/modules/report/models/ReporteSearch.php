<?php

namespace frontend\modules\report\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\report\models\Reporte;

/**
 * ReporteSearch represents the model behind the search form of `frontend\modules\report\models\Reporte`.
 */
class ReporteSearch extends Reporte
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'xgeneral', 'ygeneral', 'xlogo', 'ylogo', 'x_grilla', 'y_grilla', 'registrosporpagina', 'xresumen', 'yresumen'], 'integer'],
            [['codocu', 'codcen', 'modelo', 'nombrereporte', 'detalle', 'campofiltro', 'tamanopapel', 'tienepie', 'tienelogo', 'comercial', 'tienecabecera'], 'safe'],
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
        $query = Reporte::find();

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
            'xgeneral' => $this->xgeneral,
            'ygeneral' => $this->ygeneral,
            'xlogo' => $this->xlogo,
            'ylogo' => $this->ylogo,
            'x_grilla' => $this->x_grilla,
            'y_grilla' => $this->y_grilla,
            'registrosporpagina' => $this->registrosporpagina,
            'xresumen' => $this->xresumen,
            'yresumen' => $this->yresumen,
        ]);

        $query->andFilterWhere(['like', 'codocu', $this->codocu])
            ->andFilterWhere(['like', 'codcen', $this->codcen])
            ->andFilterWhere(['like', 'modelo', $this->modelo])
            ->andFilterWhere(['like', 'nombrereporte', $this->nombrereporte])
            ->andFilterWhere(['like', 'detalle', $this->detalle])
            ->andFilterWhere(['like', 'campofiltro', $this->campofiltro])
            ->andFilterWhere(['like', 'tamanopapel', $this->tamanopapel])
            ->andFilterWhere(['like', 'tienepie', $this->tienepie])
            ->andFilterWhere(['like', 'tienelogo', $this->tienelogo])
            ->andFilterWhere(['like', 'comercial', $this->comercial])
            ->andFilterWhere(['like', 'tienecabecera', $this->tienecabecera]);

        return $dataProvider;
    }
}

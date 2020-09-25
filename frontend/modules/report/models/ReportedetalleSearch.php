<?php

namespace frontend\modules\report\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\report\models\Reportedetalle;

/**
 * ReporteSearch represents the model behind the search form of `frontend\modules\report\models\Reporte`.
 */
class ReportedetalleSearch extends Reportedetalle
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           // [['id', 'xgeneral', 'ygeneral', 'xlogo', 'ylogo', 'x_grilla', 'y_grilla', 'registrosporpagina', 'xresumen', 'yresumen'], 'integer'],
            [['nombre_campo','aliascampo'], 'safe'],
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
    public function searchByReporte($params,$filter)
    {
        $query = Reportedetalle::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,'pagination' => [
                                'pageSize' => 100,
                        ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(['like', 'nombre_campo', $this->nombre_campo])
            ->andFilterWhere(['like', 'aliascampo', $this->aliascampo])
            ->andFilterWhere(['hidreporte'=>$filter]);

       
        return $dataProvider;
    }
}

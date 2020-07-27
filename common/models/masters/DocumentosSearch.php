<?php

namespace common\models\masters;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\masters\Documentos;

/**
 * DocumentosSearch represents the model behind the search form of `common\models\Documentos`.
 */
class DocumentosSearch extends Documentos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codocu', 'desdocu', 'clase', 'tipo', 'tabla', 'abreviatura', 'prefijo', 'escomprobante'], 'safe'],
            [['idreportedefault'], 'integer'],
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
        $query = Documentos::find();

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
            'idreportedefault' => $this->idreportedefault,
        ]);

        $query->andFilterWhere(['like', 'codocu', $this->codocu])
            ->andFilterWhere(['like', 'desdocu', $this->desdocu])
            ->andFilterWhere(['like', 'clase', $this->clase])
            ->andFilterWhere(['like', 'tipo', $this->tipo])
            ->andFilterWhere(['like', 'tabla', $this->tabla])
            ->andFilterWhere(['like', 'abreviatura', $this->abreviatura])
            ->andFilterWhere(['like', 'prefijo', $this->prefijo])
            ->andFilterWhere(['like', 'escomprobante', $this->escomprobante]);

        return $dataProvider;
    }
}

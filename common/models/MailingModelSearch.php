<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MailingModel;

/**
 * MailingModelSearch represents the model behind the search form of `common\models\MailingModel`.
 */
class MailingModelSearch extends MailingModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'universidad_id', 'facultad_id', 'order'], 'integer'],
            [['ruta', 'activo', 'idioma', 'titulo', 'remitente', 'cuerpo', 'copiato', 'transaccion', 'codocu', 'posic', 'texto', 'parametros', 'reply'], 'safe'],
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
        $query = MailingModel::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'universidad_id' => $this->universidad_id,
            'facultad_id' => $this->facultad_id,
            'order' => $this->order,
        ]);

        $query->andFilterWhere(['like', 'ruta', $this->ruta])
            ->andFilterWhere(['like', 'activo', $this->activo])
            ->andFilterWhere(['like', 'idioma', $this->idioma])
            ->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'remitente', $this->remitente])
            ->andFilterWhere(['like', 'cuerpo', $this->cuerpo])
            ->andFilterWhere(['like', 'copiato', $this->copiato])
            ->andFilterWhere(['like', 'transaccion', $this->transaccion])
            ->andFilterWhere(['like', 'codocu', $this->codocu])
            ->andFilterWhere(['like', 'posic', $this->posic])
            ->andFilterWhere(['like', 'texto', $this->texto])
            ->andFilterWhere(['like', 'parametros', $this->parametros])
            ->andFilterWhere(['like', 'reply', $this->reply]);

        return $dataProvider;
    }
}

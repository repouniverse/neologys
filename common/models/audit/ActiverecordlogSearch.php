<?php
namespace common\models\audit;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\audit\Activerecordlog;

/**
 * CliproSearch represents the model behind the search form of `common\models\masters\Clipro`.
 */
class ActiverecordlogSearch extends Activerecordlog
{
    /**
     * {@inheritdoc}
     ** @property string $id
 * @property string $model
 * @property string $field
 * @property string $ip
 * @property string $creationdate
 * @property string $controlador
 * @property string $description
 * @property string $nombrecampo
 * @property string $oldvalue
 * @property string $newvalue
 * @property string $username
 * @property string $metodo
 * @property string $action
 * @property string $clave*/
    public function rules()
    {
        return [
            [['id', 'model', 'field', 'ip', 'controlador', 'username'], 'safe'],
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
        $query = Clipro::find();

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
        $query->andFilterWhere(['like', 'codpro', $this->codpro])
            ->andFilterWhere(['like', 'despro', $this->despro])
            ->andFilterWhere(['like', 'rucpro', $this->rucpro])
            ->andFilterWhere(['like', 'telpro', $this->telpro])
            ->andFilterWhere(['like', 'web', $this->web])
            ->andFilterWhere(['like', 'deslarga', $this->deslarga]);

        return $dataProvider;
    }
    
    public function searchByCodpro($codpro)
    {
        $query = Clipro::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        

        // grid filtering conditions
        $query->andFilterWhere(['=', 'codpro', $codpro]);

        return $dataProvider;
    }
    
     public function searchByModel($model)
    {
        $query = Activerecordlog::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        

        // grid filtering conditions
        
        $query->andFilterWhere(['model'=>$model,
            'model'=>$model::className(),
            'clave'=>$model->getPrimaryKey(),
            ]);

        return $dataProvider;
    }
}

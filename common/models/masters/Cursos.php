<?php

namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "cursos".
 *
 * @property int $id
 * @property string|null $codcur
 * @property string|null $descripcion
 * @property string|null $ciclo
 * @property string|null $activo
 * @property int|null $plan_id
 */
class Cursos extends \common\models\base\modelBase
{
    const SCE_IMPORTACION='importacion';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cursos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codcur','descripcion','activo'],'safe','on'=>self::SCE_IMPORTACION],
            [['codcur','descripcion'],'required'],
            [['plan_id'], 'integer'],
            [['codcur'], 'string', 'max' => 18],
            [['descripcion'], 'string', 'max' => 40],
            [['ciclo'], 'string', 'max' => 2],
            [['activo'], 'string', 'max' => 1],
        ];
    }

    public function scenarios() {

        $scenarios = parent::scenarios();
        $scenarios[self::SCE_IMPORTACION] = [
           'codcur', 'descripcion','activo'
            ];
        
        return $scenarios;
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'codcur' => Yii::t('app', 'Codcur'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'ciclo' => Yii::t('app', 'Ciclo'),
            'activo' => Yii::t('app', 'Activo'),
            'plan_id' => Yii::t('app', 'Plan ID'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return CursosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CursosQuery(get_called_class());
    }
}

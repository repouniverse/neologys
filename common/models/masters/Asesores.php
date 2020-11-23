<?php

namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "{{%asesores}}".
 *
 * @property int $id
 * @property int $asesor_id
 * @property int|null $persona_id
 * @property string|null $orcid
 * @property string|null $activo
 */
class Asesores extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */

    const SCE_IMPORTACION='importacion_asesores';

public $booleanFields=['activo'];

    public static function tableName()
    {
        return '{{%asesores}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {

        return [
            [['persona_id'], 'integer'],
            [['orcid'], 'string', 'max' => 250],
            [['activo'],'safe'],           
        ];
    }

    public function scenarios() {

        $scenarios = parent::scenarios();
        $scenarios[self::SCE_IMPORTACION] = [
           'asesor_id','persona_id', 'orcid','activo'
            ];
        
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'persona_id' => Yii::t('base_labels', 'Assesor'),
            'orcid' => Yii::t('base_labels', 'ORCID'),
            'activo' => Yii::t('base_labels', 'Active'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return AsesoresQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AsesoresQuery(get_called_class());
    }

    public function getPersona()
    {
        return $this->hasOne(Personas::className(), ['id' => 'persona_id']);
    }

}

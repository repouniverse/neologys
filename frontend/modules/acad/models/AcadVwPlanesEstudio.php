<?php

namespace frontend\modules\acad\models;

use Yii;

/**
 * This is the model class for table "{{%acad_vw_planes_estudio}}".
 *
 * @property int $id
 * @property string $codperiodo
 * @property string $descripcion
 * @property int $carrera_id
 * @property string|null $activo
 * @property string $codcurso
 * @property string $codcursocorto
 * @property int $creditos
 * @property string $ciclo
 * @property int|null $hteoria
 * @property int|null $hpractica
 * @property string|null $obligatoriedad
 * @property string|null $tipoproceso
 * @property string|null $codareaesp
 * @property string|null $codesp
 * @property string $nombre
 * @property string $acronimo
 * @property string|null $codcur
 * @property string|null $nombrecurso
 * @property string|null $ciclocurso
 */
class AcadVwPlanesEstudio extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%acad_vw_planes_estudio}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'carrera_id', 'creditos', 'hteoria', 'hpractica'], 'integer'],
            [['codperiodo', 'descripcion', 'carrera_id', 'codcurso', 'codcursocorto', 'creditos', 'ciclo', 'nombre', 'acronimo'], 'required'],
            [['codperiodo', 'codcursocorto'], 'string', 'max' => 10],
            [['descripcion', 'nombre'], 'string', 'max' => 60],
            [['activo', 'obligatoriedad'], 'string', 'max' => 1],
            [['codcurso', 'codcur'], 'string', 'max' => 18],
            [['ciclo', 'tipoproceso'], 'string', 'max' => 3],
            [['codareaesp'], 'string', 'max' => 6],
            [['codesp'], 'string', 'max' => 8],
            [['acronimo'], 'string', 'max' => 12],
            [['nombrecurso'], 'string', 'max' => 40],
            [['ciclocurso'], 'string', 'max' => 2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'codperiodo' => Yii::t('base_labels', 'Codperiodo'),
            'descripcion' => Yii::t('base_labels', 'Descripcion'),
            'carrera_id' => Yii::t('base_labels', 'Carrera ID'),
            'activo' => Yii::t('base_labels', 'Activo'),
            'codcurso' => Yii::t('base_labels', 'Codcurso'),
            'codcursocorto' => Yii::t('base_labels', 'Codcursocorto'),
            'creditos' => Yii::t('base_labels', 'Creditos'),
            'ciclo' => Yii::t('base_labels', 'Ciclo'),
            'hteoria' => Yii::t('base_labels', 'Hteoria'),
            'hpractica' => Yii::t('base_labels', 'Hpractica'),
            'obligatoriedad' => Yii::t('base_labels', 'Obligatoriedad'),
            'tipoproceso' => Yii::t('base_labels', 'Tipoproceso'),
            'codareaesp' => Yii::t('base_labels', 'Codareaesp'),
            'codesp' => Yii::t('base_labels', 'Codesp'),
            'nombre' => Yii::t('base_labels', 'Nombre'),
            'acronimo' => Yii::t('base_labels', 'Acronimo'),
            'codcur' => Yii::t('base_labels', 'Codcur'),
            'nombrecurso' => Yii::t('base_labels', 'Nombrecurso'),
            'ciclocurso' => Yii::t('base_labels', 'Ciclocurso'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return AcadVwPlanesEstudioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AcadVwPlanesEstudioQuery(get_called_class());
    }
    
    private function queryDocente(){
        return AcadRespoSyllabus::find()->andWhere([
            'plan_estudio_id'=>$this->plan_detalle_id,            
            ]);
    }
    public function hasDocente($docente_id=null){
        
       return $this->queryDocente()->andFilterWhere(['docente_id'=>$docente_id])->exists();
    }
    
    public function idDocente(){
        if(!$this->hasDocente())return false;
       return $this->queryDocente()->one()->id;
    }
    
   
    
}

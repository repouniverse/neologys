<?php

namespace common\models\masters;
use common\helpers\FileHelper;
use Yii;

/**
 * This is the model class for table "{{%grupo_personas}}".
 *
 * @property string $codgrupo
 * @property string $desgrupo
 * @property string $modelo
 * @property string|null $detalle
 *
 * @property Persona[] $personas
 */
class GrupoPersonas extends \common\models\base\modelBase
{
   /*
    * Propiedad para alacenar la ruta donde se guardan so archios de las 
    * cistas para los paneles de bienvenida 
    */
    public $panelPath='frontend/views/layouts/perfiles'; 
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%grupo_personas}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codgrupo', 'desgrupo', 'modelo'], 'required'],
            [['detalle'], 'string'],
            [['layout'], 'safe'],
            [['codgrupo'], 'string', 'max' => 3],
            [['desgrupo'], 'string', 'max' => 60],
            [['modelo'], 'string', 'max' => 100],
            [['codgrupo'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codgrupo' => Yii::t('base_labels', 'Group Code'),
            'desgrupo' => Yii::t('base_labels', 'Group Description'),
            'modelo' => Yii::t('base_labels', 'Model'),
            'detalle' => Yii::t('base_labels', 'Detail'),
        ];
    }

    /**
     * Gets query for [[Personas]].
     *
     * @return \yii\db\ActiveQuery|PersonaQuery
     */
    public function getPersonas()
    {
        return $this->hasMany(Persona::className(), ['codgrupo' => 'codgrupo']);
    }

    /**
     * {@inheritdoc}
     * @return GrupoPersonasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GrupoPersonasQuery(get_called_class());
    }
    /*
     * dEVUELVE UN ARRAY DE RUTAS A LOS 
     */
    public function mapFiles(){
        $mapDir = Yii::getAlias('@'.$this->panelPath);
        $mapDir =FileHelper::normalizePath($mapDir);
     $options = ['filter' => function ($path) {
         if (is_dir($path)) {
             $file = basename($path);
             if (substr($file,0,5) == 'panel') {
                 return false;
             }else{
                 return true;
             }
         }
         return;
     }, 'only' => ['*.php'], 'except' => [],'recursive'=>false];
    
     
     
        return FileHelper::mapFilesView(FileHelper::findFiles($mapDir,
                $options));
        
        
        
    }
    
}

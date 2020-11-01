<?php

namespace common\models\masters;
use common\models\base\modelBaseTrait;
use common\models\base\modelBase;
use common\models\masters\Parametrosdocu;
use yii\data\ActiveDataProvider;
use common\models\config\Parametroscentrosdocu;
use Yii;

/**
 * This is the model class for table "{{%documentos}}".
 *
 * @property string $codocu
 * @property string $desdocu
 * @property string $clase
 * @property string $tipo
 * @property string $tabla
 * @property string $abreviatura
 * @property string $prefijo
 * @property string $escomprobante Define si es un comprobante 
 * @property int $idreportedefault Indica el id del reporte por defaul, sirve para visualizar un documento 
 */
class Documentos extends modelBase
{
    use modelBaseTrait;
    /**
     * {@inheritdoc}
     */
    public $booleanFields=['withaudit'];
    
    public static function tableName()
    {
        return '{{%documentos}}';
    }

    
    public function behaviors() {
        return [
             'auditoriaBehavior' => [ 
                'class' => '\common\behaviors\AuditBehavior',
            ],
            
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codocu', 'desdocu'], 'required'],
             [['codocu'], 'match', 'pattern' => '/[1-9]{1}[0-9]{2}/','message'=>yii::t('base.errors','The {field} doesn\'t match with format')],
            [['idreportedefault'], 'integer'],
            [['codocu'], 'string', 'max' => 3],
            [['withaudit'], 'safe'],
            [['desdocu', 'tabla'], 'string', 'max' => 60],
            [['clase', 'escomprobante'], 'string', 'max' => 1],
            [['tipo'], 'string', 'max' => 2],
            [['abreviatura'], 'string', 'max' => 5],
            [['prefijo'], 'string', 'max' => 4],
            [['codocu'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codocu' => yii::t('base_labels','Document Code'),
            'desdocu' => yii::t('base_labels','Document'),
            'clase' => yii::t('base_labels','Class'),
            'tipo' => yii::t('base_labels','Type'),
            'tabla' => yii::t('base_labels','Table'),
            'abreviatura' => yii::t('base_labels','Abbreviation'),
            'prefijo' => yii::t('base_labels','Prefix'),
            'escomprobante' => yii::t('base_labels','It is proof'),
            'idreportedefault' => yii::t('base_labels','Default report'),
        ];
    }
    
     public function afterSave($insert,$changedAttributes){
        //if($insert)
        //$this->loadParametros();
        return parent::afterSave($insert,$changedAttributes);
    }
    /*
     * Carga los parametros en la talba parametros docu a llenar autoamticamente 
     */
    private function loadParametros(){
      $params=Parametros::find()->where(['activo' => '1', 'flag' => 'D'])->all();
      $codocu=$this->codocu;
      //var_dump($centro);die();
      
      foreach($params as $fila){
          $attributes=['codocu'=>$codocu,
              'codparam'=>$fila->codparam];
          Parametrosdocu::firstOrCreateStatic($attributes);
      }
   }
   
   
   public function getParametroscentrosdocu(){
       return $this->hasMany(Parametroscentrosdocu::className(), ['codocu' => 'codocu']);
       
   }
   
   /*Devuelve un data provider de lso parametros de configurtacionb
    * Observe que hace reerencia a la clase Parametroscentrosdocu tabla
    *   'parametrosdocucentros'
    */
   public function providerParam(){
            return new ActiveDataProvider([
                'query' =>Parametroscentrosdocu::find()->where(['codocu'=>$this->codocu]),
                'pagination' => [
                    'pageSize' => 20,
                            ],
                                    ]);
        }
   
}

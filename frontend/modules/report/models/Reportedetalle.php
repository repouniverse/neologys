<?php

namespace frontend\modules\report\models;
use frontend\modules\report\models\Reporte;
use Yii;

/**
 * This is the model class for table "{{%reportedetalle}}".
 *
 * @property int $id
 * @property string $codocu
 * @property string $left
 * @property string $top
 * @property string $font_size
 * @property string $font_family
 * @property string $font_weight
 * @property string $font_color
 * @property string $nombre_campo
 * @property string $lbl_left
 * @property string $lbl_top
 * @property string $lbl_font_size
 * @property string $lbl_font_weight
 * @property string $lbl_font_family
 * @property string $lbl_font_color
 * @property string $visiblelabel
 * @property string $visiblecampo
 * @property int $hidreporte
 * @property string $aliascampo
 * @property int $longitudcampo
 * @property string $tipodato
 * @property string $esdetalle
 * @property string $esatributo
 * @property int $hidcoordocs
 * @property string $totalizable
 * @property string $esnumerico
 * @property string $adosaren
 *
 * @property Reportes $hidreporte0
 */
class Reportedetalle extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%reportedetalle}}';
    }

    public $booleanFields=['visiblelabel','visiblecampo','esdetalle'];
    private $camposAtributos=[
        'left',
	'top',
	'font_size',
	'font_family',
	'font_weight',
	'font_color',
	'lbl_left',
	'lbl_top',
	'lbl_font_size',
	'lbl_font_family',
	'lbl_font_weight',
	'lbl_font_color',
    ];
    
    private $camposAtributosLabel=[      
	'lbl_left',
	'lbl_top',
	'lbl_font_size',
	'lbl_font_family',
	'lbl_font_weight',
	'lbl_font_color',
    ];
    private $camposAtributosValue=[      
	'left',
	'top',
	'font_size',
	'font_family',
	'font_weight',
	'font_color',
    ];
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           // [['codocu', 'left', 'top', 'nombre_campo', 'hidreporte'], 'required'],
            [['hidreporte', 'longitudcampo', 'hidcoordocs'], 'integer'],
            [['codocu'], 'string', 'max' => 3],
            [['left', 'top', 'font_size', 'font_weight', 'font_color', 'lbl_left', 'lbl_top', 'lbl_font_size', 'lbl_font_weight'], 'string', 'max' => 10],
            [['font_family'], 'string', 'max' => 18],
            [['nombre_campo'], 'string', 'max' => 60],
            [['lbl_font_family', 'lbl_font_color'], 'string', 'max' => 35],
            [['esatributo', 'totalizable', 'esnumerico'], 'string', 'max' => 1],
            [['aliascampo'], 'string', 'max' => 40],
            [['tipodato'], 'string', 'max' => 30],
            [['esdetalle','visiblelabel','visiblecampo'], 'safe'],
            [['adosaren'], 'string', 'max' => 15],
            [['hidreporte'], 'exist', 'skipOnError' => true, 'targetClass' => Reporte::className(), 'targetAttribute' => ['hidreporte' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base.names', 'ID'),
            'codocu' => Yii::t('base.names', 'Codocu'),
            'left' => Yii::t('base.names', 'Left'),
            'top' => Yii::t('base.names', 'Top'),
            'font_size' => Yii::t('base.names', 'Font Size'),
            'font_family' => Yii::t('base.names', 'Font Family'),
            'font_weight' => Yii::t('base.names', 'Font Weight'),
            'font_color' => Yii::t('base.names', 'Font Color'),
            'nombre_campo' => Yii::t('base.names', 'Nombre Campo'),
            'lbl_left' => Yii::t('base.names', 'Lbl Left'),
            'lbl_top' => Yii::t('base.names', 'Lbl Top'),
            'lbl_font_size' => Yii::t('base.names', 'Lbl Font Size'),
            'lbl_font_weight' => Yii::t('base.names', 'Lbl Font Weight'),
            'lbl_font_family' => Yii::t('base.names', 'Lbl Font Family'),
            'lbl_font_color' => Yii::t('base.names', 'Lbl Font Color'),
            'visiblelabel' => Yii::t('base.names', 'Visiblelabel'),
            'visiblecampo' => Yii::t('base.names', 'Visiblecampo'),
            'hidreporte' => Yii::t('base.names', 'Hidreporte'),
            'aliascampo' => Yii::t('base.names', 'Aliascampo'),
            'longitudcampo' => Yii::t('base.names', 'Longitudcampo'),
            'tipodato' => Yii::t('base.names', 'Tipodato'),
            'esdetalle' => Yii::t('base.names', 'Esdetalle'),
            'esatributo' => Yii::t('base.names', 'Esatributo'),
            'hidcoordocs' => Yii::t('base.names', 'Hidcoordocs'),
            'totalizable' => Yii::t('base.names', 'Totalizable'),
            'esnumerico' => Yii::t('base.names', 'Esnumerico'),
            'adosaren' => Yii::t('base.names', 'Adosaren'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReporte()
    {
        return $this->hasOne(Reporte::className(), ['id' => 'hidreporte']);
    }

    /**
     * {@inheritdoc}
     * @return ReportedetalleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ReportedetalleQuery(get_called_class());
    }
    
    
        
    
    
    /*
     * Esta funcion devuelve una cadena de estilo
     * de acuerdo al campo del modelo sea una etiqueta (campo que cmoienza con "lbl")
     * o un valor 
     * por ejemplo: 
     * 'lbl_font_size' => 'font-size: 8px;'
     * 'font_family'=>'font-family: Arial;'
     * @atributo : Es el nombre del campo, debe de estar dentro del 
     * array de la propiedad $camposAtributos
     */
    private function putStyleElement($atributo){
        $original=$atributo;
        //$cadenalabel="";
        $cadena="";
       if(!empty($this->{$atributo} )){
          //var_dump($this->{$original},$original);if($this->{$original}=='0')die();
        $valorcorregido=$this->fixPosition($original);
         //
         if ( substr ( $atributo , 0 , strpos ( $atributo , "_" ) ) == "lbl" ){
            $atributo = str_replace ( "lbl_" , "" , $atributo );//QUITAR EL PREFIJO X EJ "LB_TOP" => "TOP";
            $cadena = " " . $atributo . ":" . $valorcorregido . "; "; //ASIGNAR EL ESTILO  XEJ   font-size=8px;
	}else{
            $cadena .= " " . $atributo . ":" . $valorcorregido . "; ";
             $cadena = str_replace ( "font-color" , "color" , $cadena );  
        }
        $cadena = str_replace ( "_" , "-" , $cadena );//REEMPLAZAR  EL "_" por "-" , ya que los nombre de los campos no puedieron nombrarse con el -;
     // $cadena=str_replace ( "font-color" , "color" , $cadena ); 
      //$cadena .="yapita: ".$valorcorregido."como la ves; ";
       }
       
        
        return $cadena;
    }
    
    
     private function putStyleElements($atributo,$isvalue){
      if(!$isvalue){//si es etiqueta
          $atributostoeach=$this->camposAtributosLabel;
          
      }else{
           $atributostoeach=$this->camposAtributosValue;
      }
        $estilo=" position:absolute; ";
         foreach($atributostoeach as $clave=>$campo){           
                $estilo.=$this->putStyleElement($campo);
                }               
        $estilo=str_replace ( "font-color" , "color" , $estilo);        
        return $estilo;
    }
    
    
    
    /*
     * Esta funcion pinta un div <Label> <Valor>
     * C0b sus respectivos estilos
     * @atributo:Nombre de un campo
     * @valor:Valor que aparece en el reporte
     */
    public function putStyleField($campo,$valor){
        $cadena="";
        $estilolabel="";
           $estilovalue="";
       if(!empty($valor)){
          // echo "d";die();
            //if(!empty($this->{$atributo}))
            $estilolabel.=$this->putStyleElements($campo,false); ///label
            $estilovalue.=$this->putStyleElements($campo,true);///value
        
        if ($this->visiblelabel)       
	$cadena= \yii\helpers\Html::tag ("div", $this->aliascampo ,["style" => $estilolabel]);
	if ( $this->visiblecampo )
         $cadena.= \yii\helpers\Html::tag ("div" , $valor,["style" => $estilovalue]);   
      
       }
        
       // var_dump($this->visiblelabel,$this->visiblecampo );die();
       return $cadena;
    }
    
   /* public function esdetalle(){
        if(trim($this->esdetalle)==='' or is_null($this->detalle) or empty($this->detalle)){
            return false;
        }else{
            return true;
        }
    }
   */ 
    
    public static function  prepareValues($hidreporte,$codocu,$nameField,$aliasField,$sizeField,$typeField){
        //echo "size " ;var_dump($sizeField);var_dump($typeField);
        $valores=[
		   'codocu'=>$codocu,
		   'left'=>'0',
		   'top'=>'0',
		   'font_size'=>'8',
		   'font_family'=>'arial',
		   'font_weight'=>'bold',
		   'font_color'=>'#000',
		   'nombre_campo'=>$nameField,
		   'lbl_left'=>'0',
		   'lbl_top'=>'0',
		   'lbl_font_size'=>'8',
		   'lbl_font_family'=>'arial',
		   'visiblelabel'=>'0',
		   'lbl_font_color'=>'#000',
		   'visiblecampo'=>'0',
		   'hidreporte'=>$hidreporte,
		   'aliascampo'=>$aliasField,
		    'longitudcampo'=>$sizeField,
		   'tipodato'=>$typeField,
   ];
       // $nuevo=self::instance();
       
        //$nuevo->setAttributes($valores);
        //echo "veri";
        return $valores;
        //self::firstOrCreateStatic($valores);
        
       /* if(!$nuevo->insert()){
            print_r($nuevo->getErrors());die();
        }*/
         
        //unset($nuevo);
    }
    
  public function camposAtributos(){
      return $this->camposAtributos;
  }  
  
  /*Si es un campo atributo debde de estar dentro del array camposatributos*/
  public function isFieldAttribute($nameField){
      return in_array($nameField,$this->camposAtributos);
  }
  /*
   * Corrige la posicion de acuerdo a las coordenadas generales 
   *  left= left + xgeneral
   *  top=  top + topgeneral 
   */
  public function fixPosition($nameField){
     
      $valor=$this->{$nameField};
      if(!(strpos($nameField,'left')===false))
                            {
                               $lon=(strpos($valor,'px')===false)?strlen($valor):strpos($valor,'px');
                                $valor=(integer)substr($valor,0,$lon)+(integer)$this->reporte->xgeneral;
                                $valor=$valor.'px';
                          
                            }
        
        if(!(strpos($nameField,'top')===false))
                            {
                                $lon=(strpos($valor,'px')===false)?strlen($valor):strpos($valor,'px');
                                $valor=(integer)substr($valor,0,$lon)+(integer)$this->reporte->ygeneral;
                                $valor=$valor.'px';
                            }
    return $valor;
  }
  
  
  
  
}

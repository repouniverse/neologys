<?php
/*
 * Creador : Julian Ramírez Tenorio  jramirez@neotegnia.com
 * 15/11/2018
 * Esta clase descendiente de la clase ActiveRecord, es la base
 * para toda la aplicación, han sido agregadas muchas funciones 
 * útiles, que facilitan el trabajo de desarrollo; entre ellas:
 * 
 * 
 * Manipulación de fechas :
 * ========================
 * 
 *                  Guardar en formato:  'YYYY-m-d' ó el que configure
 *                  Mostrar en formato:  'dd/mm/YYYY', 'd.m.Y' ..., o el que configure
 * No tiene que preocuparse de convetir formatos, todo el trabajo se 
 * delega al evento afterFind(), y beforeSave() de la clase, ella se 
 * encargará de convertirlos automáticamente. Sólo tiene que registrar los 
 * campos que son fechas u horas o dateTimes en la propiedad 'dateOrTimeFields'
 * que es un array de nombres de campos.
 * 
 * Manipule estos campos  fechas con la potencia de la clase 'Carbon', para 
 * esto sólo tiene que agregar el campo en la función  'toCarbon()'
 * 
 * Estas son algunas de las funciones útiles de esta clase
 * carbonNow()
 * formatDate()
 * getGeneralFormat()
 * openBorder()
 * prepareTimeFields()
 * swichtDate()
 * toCarbon()
 * 
 * 
 * 
 * 
 * Manipulación de Relaciones de Modelos
 * ======================================
 * 
 * 
 * Si bien  Yii posee muchas funciones para relacionar modelos valiéndose
 * de las relaciones del Motor de Base de Datos;Siempre hacen falta ir un poco
 * más allá; por ejemplo la clase ActiveRecord no tiene ninguna funcion que
 * devuelva en una matriz todas las relaciones del modelo, las llamadas a estas
 * relaciones se hacen explícitamente (Osea tienes que colocar el nombre del
 * modelo relacionado). Pero cuando programas nunca tienes que ser espècífico
 * tienes que ser general, por eso estas funcines te ayudaran a generar
 * código sin tener que colocar nombres explicitos, si no mas bien variables 
 * 
 * childModels()
 * parentModels()
 * fieldHasChilds()
 * fieldLinks()
 * fillRelations()
 * hasChilds()
 * isSimpleRelation()
 * is_relatedField()
 * obtenerForeignClass()
 * obtenerForeignField()
 * 
 *  Inspiración: Relaciones  ACCESS
 * 
 * 
 * Atajos para creación de registros 
 * ==================================
 * 
 *  Si quieres crear un registro y  verificar si existen estos valores; normalmente escribes 2 o más
 *  líneas de código:  Primero verificar si el registro exioste y  si no insertarlo
 * 
 * Tienes la función estática
 * firstOrCreateStatic($campos) 
 * 
 * La cual creará el registro siempre y cuando no exista en la tabla, para ello solo tienes
 * que pasarle los valores ['campo1'=>valor1, 'campo2'=>valor2, ...] para verificarlos 
 * 
 * Inspiración: Clase Eloquent  LARAVEL 
 * 
 * Campos Booleanos
 * =================
 * 
 * Para aquellos campos que en al base de datos tengan valores como 
 * convenciones   char(1)   '1' Y '0'  como true  y false , lo cual tiene 
 * muchas ventajas de portabilidad entre diversos motores de datos; siempre
 * lidiamos con tener que verificar  esto :
 *     if($mimodelo->activa=='1')  , para evitar esto , y hacerlo de la
 *   siguiente manera  if($mimodelo->activa), sólo registre en la 
 * propiedad  'booleanFields' estos campos a ser tratados como Boooleanos
 * y la clase se encargará del resto
 * 
 * Inspiración: Clase Eloquent  LARAVEL 
 * 
 * 
 * 
 * Generacion de Correlativos 
 * ===========================
 * 
 * Cuando creas un nuevo registro en especial de datos maestros 
 * inserta en el evento beforeSave() la función 'correlativo'  y se generará
 * un correlativo con la serie  pejemplo :   0001, 0002, 0003, 
 * detecta automáticamente el tamaño del campo en la base de datos 
 * y lo rellena con ceros, opciones de colocar un prefijo o limitar la longitud
 * de la cadena
 * 
 * 
 * Detectar cambios en el registro actual y en cada campo
 * =======================================================
 * Detecta si el usuario a modificado el registro o si ha editado algún campo
 * del modelo  funcion hasChanged()
 * 
 * Inspiración: Buffer  VFP 
 * 
 * Funciones Helpers
 * ===================
 * RawTableName(): Devuelve el nombre de la tabla de la base de datos sin el prefijo
 * possibleSearchables(): Devuelve los nombres de los campos que no son campos maestros y son cadenas de texto 
 *                      por ejemplo nombres, apellidos, descripcion, direcciones, ..etc
 * comboValueField(): Devuelve un array de valores almacenados en la tabla general combo Valores
 * firstSafedAttribute(): El primer campo establecido en modo Safe
 * getFirstError() : Devuelve una cadena con el primer error
 * getSafeFields(): Array con los nombres de los campos safe en el escenario actual
 * 
 * 
 * 
 * 
 * 
 * Bloqueo de Campos
 * =================
 * 
 * En lugar de verificar en cada formulario si este campo puede ser editado o no
 * esta clase te dice cuando un campo no puede ser modificado por integridad referencial
 * o porque tiene registros hijos y es sensible a modificación. Automáticamente
 * pinta gris en el input HTML, y no podrá ser editado
 * 
 * blockedFields()
 * fieldHasChilds()
 * isBlockedField()
 * ruleBlockedField()
 * validateBlockedField()
 * 
 * Inspiración: SAPGUI -SAP R3 
 * 
 * 
 */
namespace common\models\base;
use Carbon\Carbon;

use Yii;
use DateTime;
use common\helpers\FileHelper;
use  yii\web\ServerErrorHttpException;
use common\models\base\modelBaseTrait;
use common\interfaces\documents\baseInterface;
use common\models\Documentos;
use common\helpers\h;

class modelBase extends \yii\db\ActiveRecord  

{
   use modelBaseTrait;
    
    const PREFIX_ADVANCED = '@';
    const PREFIX_BASIC = '/';
     const MESSAGE_ERROR='error';
     const MESSAGE_WARNING='warning';
        const MESSAGE_SUCCESS='success';
    /*tipos de formatos de fechas a asignar a un campo en 
     * la propiedad $dateorTimeFields (mire los comentarios de esta propiedad, vea el ejemplo) 
     */
    const _FDATE='date';
    const _FDATETIME='datetime';
    const _FTIME='time';
    const _FHOUR='hour';
    
    /* claves para transformar los formatos de fechas  
     **/
    const _FORMATUSER='timeUser'; //Formato (salida) para humanos, es decir formato para visulizarlos en los formularios y reportes
    const _FORMATBD='timeBD';//formato para guardarlo en la base de datos como porje jemplo  Y-m-d H:i:s'
    
    
    /*Esta propieda des una matriz de asociacion entre un campo
     * y la tablas de valores comboValores 
     * Se usa para extraer valores de esta tabla de la siguietne forma
     * Por ejemplo
      En la tabla Maestrocompo hay un campo tipo de material
     *    [
     *       'codtipo'=>   'maestrocompo.codtipo' 

     *        
     *        ] 
     * Asociara los valores de esta clave (maestrocompo.codtipo 
     * para sacar un combo o lista de valores de la tabla  comboValores
     *   '100' -- FERRETERIA
     *   '200' -- INSUMOS DE PROD 
     *    ..
     */
    public $fakeRelations=[];
    
    private $_routePrefix;
    
    public $prefijo=null;
    //public $withAudith=false;
    public $withAudit=false; /// Flag para establecer si el  registro va a dejar rastro en la auditoria 
    //public $codigodoc;//codigo documento
    //public $_documento=null;//prefijo codigo documento
    public $_linkFields=array(); ///array , almacena los nombres de los camppos relacionados
                          //con otros modelos 
    public $_obRelations=array(); //Almacena las funciones de relacion 
     //en una matriz (atributo $_obRelation) 
    /*
     * Ejemplo de esta propiedad 
     *    'Maestro'=>       [
     *                          [   'campo1_foraneo'=>'campo1_de_actual_modelo,
     *                              'campo2_foraneo'=>'campo2_de_actual_modelo,
     *                            ],
     *                          true   //Si se trata de una relacion HAS_MANY=true, HAS_ONE=False
     *                          'getMaestros',   //El nombre de la funcion que obtiene el obejto activeQuery
     *                      ],
     *     'Trabajadores'=>[
     * 
     *                          ...
     *                      ]
     * 
     * 
     */
    
    
    
    
    public $hardFields=array(); //array de campos DUROS  , es decir campos que    
    //uan vez que se graba el registro y tiene hijos YA NO SE PUEDE MODIFICAR,
    //ASI NO SEA UN CAMPO LINKEADO  
    
  
    public $dateorTimeFields=array();
    //especificar en este array cuales son los campos 
    // array('campo1'=>'date',
     //      'campo2'=>'datetime'.
      //      'campo3'=>'time' )
   
    public static $mailFields=[];///arrayde nombres de campos tipo mail
    public $booleanFields=[]; // array para almacenar los campos que se consideran booleanos 
    
    
    /*Array que guarda los mensajes 
     * de usuario, algo asi como almacenar variabels de sesion
     * pero sirven para que cuando se desarrollen funciones internas dentro del modelo
     * estas queden regstrando loq ue vapasando
     * y kluego desde el controlado
     * pasarlos a un repsonse en ajax o una vista 
     * 
     */
   private $_messages=[];
   
   
  public function makeReport(){}
    
   
   
   
   
   
   //solo refresca la propiedad $_obRelations
   //public function obRelations(){
      //if(count($this->_obRelations)==0 || $force ){
          //return $this->fillObRelations();
          //return true;
                   //}
      //return false;           
                   // }
     
   /*
    * Devuelve una matriz con 
    * la sguitente estrucutura :
    *   [
    *      'campo_local_link'=>'NombreclaseForaneaRelacionada',
    *      'campo_local_link1'=>'NombreclaseForaneaRelacionada1',
    * ...
    *    ]
    * @params: onlyChilds: null todos los campos , true solo hasMany, false : SOlo HasOne
    */
  
   public function fieldsLink($onlyChilds=null){
       $campos=[];
       if(count($this->_linkFields)==0){
         
     // if(count($this->_linkFields)==0 || $force ){  
      $matriz=$this->fillRelations();//refresca la propiedad _obRelations
        //print_r(array_values($this->_obRelations));die();
      foreach($matriz as $classmodelo=>$info){ //recoore la porpiedad _obRelations
          
          if($onlyChilds===null){
             foreach($info[0] as $key=>$value){               
             $campos[$value]=$classmodelo;
            } 
          }if($onlyChilds){ //Si es true solo hijos 
              if($info[1])
                  foreach($info[0] as $key=>$value){               
                        $campos[$value]=$classmodelo;
                    } 
          }else{//si es false solo padres 
             if(!$info[1])
                  foreach($info[0] as $key=>$value){               
                        $campos[$value]=$classmodelo;
                    }   
          }
            
          }
          
          
          
          
          
          $this->_linkFields=$campos;
       }
       
         return $this->_linkFields ;       
      }
         
   
   
   /*
    * Verifica si un campo es relacionado, con otro modelo
    * Si esta dentro de la propiedad $_linkFields
    */
   public function is_relatedField($namefield){
       $this->fieldsLink();//refresca la propiedad _linkFields
     // var_dump(array_keys($this->_linkFields));
       return in_array(trim($namefield),array_keys($this->_linkFields));
   }
   
   
   
   /*
    * Verifica si un campo es relacionado, con otro modelo y ademas ya existen
    *  registros relacinados en la tabla hija
    * por lo tanto no debe de editarse este campo en el registro 
    * padre. Util para Formularios 
    */
   
   public function isBlockedField($namefield){
       $retorno=false;
       
       //Si este campo esta dentro de la lista de campos duros  y
       //el presente registro ya tiene hijos, NOS SE DIGA MAS; ESTA BLOQUEADO
       if(in_array(trim($namefield),$this->hardFields) &&
           $this->fieldHasChilds($namefield)){
           RETURN true;
       }
        
        
//verificando ahora si el campo es un campo link y ademas está con
//registros relacionados hijos  aguas abajo (HAS_MANY)        
       if($this->is_relatedField($namefield)){
           //verificar sus registros hijos
          
           $this->fillRelations();
           foreach($this->_obRelations as $clase=>$arelacion){ //recoore la porpiedad _obRelations
                 if(in_array(trim($namefield),array_values($arelacion))){
                     if(   $arelacion[1]  && ///si se trata de una reLacion HAS_MANY
                             $this->{$arelacion[2]}()->count() >0){ //si hay registro hijos relacionados 
                         $retorno=true;
                         break;
                     }
                 }
               }
       }
       
         
       
      return $retorno;
   }
   
   /*
    * VERIFICA A NIVEL DE REGISTRO si tiene hijos 
    * relacionados 
    */
   
   public function hasChilds(){
       $retorno=false;
       $this->fillRelations();
     // var_dump($this->_obRelations);
       foreach($this->_obRelations as $funcion=>$link){ //recoore la porpiedad _obRelations
                  if($link[1]){ //sis trata de una relacion uno a varios 
                     if($this->{$link[2]}()->count() >0){ //si hay registro hijos relacionados 
                        $retorno=true;                       
                        break; 
                  }
                     
                 }
               }
       return $retorno;
   }
   
   /*
    *Verifica si este atributo tiene reistros hijos
    */
   public function fieldHasChilds($attribute){
       $camposLink=$this->fieldsLink(true);
       $this->fillRelations();
       $matriz=$this->_obRelations;
     if(in_array($attribute,$camposLink)){
         $camposLinkVolteado= array_flip($camposLink);
         return ($this->{$matriz[$camposLinkVolteado[$attribute]][2]}()
                 ->count() >0)
         ?true:false;
         
     }else{
         return false;
     }
       
   }
                            
   
   
   
   
   
   /*
    * Esta funcion actualiza 
    *  el atributo $_obRelations  con las relaciones y sus links
    *   array(  'getOrders' => array('codigo'=>'codart'),
    *           'getAlconversiones' => array('codigo'=>'codart'), 
    *          ...
    *       )
    * De esta forma almacenamos todas las relaciones en una 
    * matriz:
    * Cuando queremos extraer los campos comprometidos en alguna 
    * relacion, bastará con  hace un recorrido a los valores clave 
    */
   public function fillRelations(){
      if(count($this->_obRelations)==0){
          $relaciones=[];
       $calse=new \ReflectionClass(static::class); //LA CLASE HIJA ACTUAL NO LA PADRE 
       $metods=$calse->getMethods();
       
       //print_r($metods);die();
       //yii::error($metods);
       UNSET($calse);
       foreach($metods as $key=>$object){
           /*echo trim(static::class)."<br>";
                echo trim($object->class)."<br>";
               echo trim(strtolower($object->name))."<br><br><br>";*/
           if (($object->class===static::class)){
               
              if(substr(trim(strtolower($object->name)),0,3)==='get' ){
               /*if(h::userId()==7){
                     var_dump(method_exists(static::class,$object->name));
                    var_dump(is_object($this->{$object->name}()));
                     var_dump(get_parent_class($this->{$object->name}()));
                     var_dump(get_class($this->{$object->name}()));
                     var_dump($object->name);
                       var_dump($this->{$object->name}()->link);
                       die();
               }*/
             
           } 
           }
           
               //die();
           if (($object->class===static::class) //es un metodo de la clase actual y no de los parents
               && (substr(trim(strtolower($object->name)),0,3)==='get' ) //comieniza con get
               && (method_exists(static::class,$object->name)) //si es una fucion no una propiedad
               && is_object($this->{$object->name}()) //si devuelve un objeto
               //&& in_array(get_parent_class($this->{$object->name}()),['yii\db\ActiveQuery','yii\db\Query'])  //si el objeto es una clas actiev Query
               && is_subclass_of($this->{$object->name}(), 'yii\db\ActiveQuery')
               ){
                             
                   if(array_key_exists($this->{$object->name}()->modelClass, $relaciones)){
                        $relaciones[$this->{$object->name}()->modelClass.'_xxx_'. uniqid()]=[$this->{$object->name}()->link,$this->{$object->name}()->multiple,$object->name]; //carga la propiedad  
                   }else{
                      $relaciones[$this->{$object->name}()->modelClass]=[$this->{$object->name}()->link,$this->{$object->name}()->multiple,$object->name]; //carga la propiedad  
                    
                   }
                   
                   
                   }
                       // unset($this->{$object->name}());//libera espacio 
                   } 
                   $this->_obRelations=$relaciones;
            }
      
               
                return $this->_obRelations;
             }
       
             
  /*
   * Funcion q ue devuelve el nombre de la clase
   * foranea asociada al @campo suministrado 
   * @campo : Nombre de campo suministrado 
   
   * Pregunta ¿Porqué hacer esta funcion y no usar 
   * las propiedades getXnamodel() de las funciones de las relaciones
   * hasOne()? 
   * Respuesta: Porque para usar etas funciones se deben de hacer explicitamente
   * en cambio esta funcion solo con el nombre del campo busca 
   * en la propiedad _obRelations la clase modelo a la 
   * que esta relacionado, MAGICAMENTE
   */          
  public function obtenerForeignClass($nombrecampo){
    /*yii::error('----campo ----'.$nombrecampo,__FUNCTION__);
     yii::error('----fieldlinkx  con false----',__FUNCTION__);
      yii::error($this->fieldsLink(false),__FUNCTION__);
      yii::error('----fieldlinkx  con true----',__FUNCTION__);
      yii::error($this->fieldsLink(true),__FUNCTION__);
    yii::error('----nomrecampo ----'.$nombrecampo,__FUNCTION__);*/
     $nombrecalseforanea= $this->fieldsLink(false)[$nombrecampo];
      //yii::error('----nomnreclase foranea ----'.$nombrecampo,__FUNCTION__);
     //var_dump($this->fieldsLink(true),get_class($this),$this->fieldsLink(true),$nombrecalseforanea);
     //echo "nombre clase ".$nombrecalseforanea;die();
     if(strpos($nombrecalseforanea,'_xxx_')) 
      return substr($nombrecalseforanea,0,strpos($nombrecalseforanea,'_xxx_'));
     
     return $nombrecalseforanea;
   
  }      
   
/*
 * Deveul el campo o un array de campos foraneo
 * segun la relacion 
 */  
 public function obtenerForeignField($nombrecampo){
     $arreglo=$this->fillRelations();
     $nombrecampoforaneo=null;
     $claseforanea=$this->fieldsLink(false)[$nombrecampo];
     foreach($arreglo[$claseforanea][0] as $campoforaneo=>$campolocal){
         if($nombrecampo===$campolocal){
             $nombrecampoforaneo=$campoforaneo;
         }
     }
    return $nombrecampoforaneo; 
  }      
    
  public function isSimpleRelation(){
      $retorno=true;
      $arreglo=$this->fillRelations();
      foreach($arreglo as $clave=>$valor){
         if(count($valor)>1){
             $retorno=false;break;
         }
     }
     return $retorno;
  }      
       
        
         
	     
        
        
        
        /*
         * Formatea  una fecha de acuerdo 
         * a la confinguracion general  SETTINGS 
         * configuracion (SETTINGS) donde consulta las variabels
         * que alamcena estos formatos : CATEGORIAS  'timeUSER', 'timeBD'
         * pejm  $this->gsetting('timeUSER' ($key), 'date' ($typ))  retorna una plantilla   'dd/mm/YYYY'
         * @field: nombre del campo a evaluar
         * @key : Valor ('timeUSER' , 'timeBD') para saber com quiere el formato ; para almacenarlo en la BD o mostrarlo al usuario
         * @typ : valores  'date', 'datetime' ó 'time'  dependiendo como sea
         *        el tipo configurado    
         * 
         * formatos permitidos en settings como opciones, cualquier delimitador "/" , "." , "-", "@" 
         *   dd/mm/yyyy yyyy/mm/dd d/mm/yyyy d/m/yyyy yyyy/m/d yyyy/m/dd yyyy/mm/d
         *   Con otro delimitador : 
         *   dd-mm-yyyy
         *   dd.mm.yyyy ...  etc   * 
         */
        private function setFormatTimeFromSettings($field,/*$key,$typ*,*/$show,$literal=false){
            $key=($show)?static::_FORMATUSER:static::_FORMATBD;
            $typ=$this->dateorTimeFields[$field];
            $formatToShow= $this->gsetting($key, $typ);
             $formatToAnalize= $this->gsetting($this->reverseKey($key), $typ); 
           /*yii::error('foramto para analizar :'.$formatToAnalize);
           yii::error('foramto para mostrar :'.$formatToShow);
           yii::error('typ :'.$typ);
           yii::error('key :'.$key);
            yii::error('reversekey :'.$this->reverseKey($key));*/
             //$objetof=DateTime::createFromFormat($this->getGeneralFormat($formatToAnalize,$typ,$show),$this->{$field});
                  
          $resultado=Yii::$app->formatter->asDate(
                         DateTime::createFromFormat(
                               $this->getGeneralFormat($formatToAnalize,$typ,$show),
                                                 (!$literal)?$this->{$field}:$field
                                                                            ) ,
                                                    'php:'.$this->getGeneralFormat($formatToShow,$typ,$show)
                                                       );
                  //yii::error(' El resultado : '.$resultado);
             return $resultado;
        }
        
        /*
         * valor:  El valor de la cadena que representa la fecha 
         * tipo:  cadena 'time', 'date', 'datetime'
         * show : Define el formatoq ue se le dara a la cadena $valor  true  valor para mostrar, false valor para alamecenar en labase de
         * datos 
         */
       public static function SwichtFormatDate($valor,$tipo,$show){
           $key=($show)?static::_FORMATUSER:static::_FORMATBD;//llave para buscar en la tabla settings
           //puede ser 'timeUser' o 'timeBD'
           $formatToShow= h::gsetting($key, $tipo);  
           $formatToAnalize= h::gsetting(static::reverseKey($key), $tipo); 
           
            return Yii::$app->formatter->asDate(
                         DateTime::createFromFormat(
                 static::getGeneralFormat($formatToAnalize,$tipo,$show),
                   $valor
                      ),
                'php:'.static::getGeneralFormat($formatToShow,$tipo,$show)
               );
       }
        
        
        /*
         * Formatea  los campos de fechas o horas
         * segun se quiera mostrr al usuario o 
         * almacenar en labase de datos 
         * para esto se vale de los parametros de 
         * configuracion (SETTINGS) donde consulta las variabels
           que alamcena estos formatos : CATEGORIAS  'timeUSER', 'timeBD'
         * 
         */
        public function prepareTimeFields($show){
            $this->verifyTimeFields();
           $key=($show)?static::_FORMATUSER:static::_FORMATBD;
          // $oldformat=Yii::$app->formatter->dateFormat;
            foreach($this->dateorTimeFields as $field=>$typ){
                //$this->{$field}=$this->setFormatTimeFromSettings($field,$key, $typ);
                $this->{$field}=$this->setFormatTimeFromSettings($field,/*$key*, $typ,*/$show);
            }
            //Dejamos el objeto como estaba antes 
            //Yii::$app->formatter->dateFormat=$oldformat;
            RETURN TRUE;
        }
        
        private function verifyTimeFields(){
            $allowedValues=[self::_FHOUR,self::_FDATE,self::_FDATETIME,self::_FTIME];
            foreach(array_values($this->dateorTimeFields) as $key=>$value){
                if(!in_array($value,$allowedValues)){
                    throw new ServerErrorHttpException(Yii::t('base_errors', 'Wrong property {valor}  in field time {campo} Times  ',['valor'=>$value,'campo'=>$key]));
    		                   
                }
            }
            return true;
        }
        
        public function afterFind() {
            $this->convertBooleanFields();//COnveritr a booleanos los campos
            $this->prepareTimeFields(true);//Convierte los campos fechas y tiempo en legibles
          return   parent::afterFind();
        }
        
       /* public function beforeSave($insert) {
            $this->prepareTimeFields(false);//Convierte los campos fechas y tiempo almacenables en BD
            parent::beforeSave($insert);
        }*/
            public function beforeSave($insert) {
                $insert=$this->isNewRecord;
         $this->prepareTimeFields(false);//Convierte los campos fechas y tiempo almacenables en BD
       $this->convertBooleanFields(false);
         // $this->setPrimaryKey($this->prefijo);
         return  parent::beforeSave( $insert);
        }
        public function beforeValidate() {
                $insert=$this->isNewRecord;
         //$this->prepareTimeFields(false);//Convierte los campos fechas y tiempo almacenables en BD
       $this->convertBooleanFields(true);
         // $this->setPrimaryKey($this->prefijo);
         return  parent::beforeValidate();
        }
        
        
        /*Detecta si el usuario ha modificado un campo 
         * @attribute : El campo a verificar
         * Si no especifica nada, se verificar todo el registro 
         */        
        public function hasChanged($attribute=null){ 
            //yii::error('Funcion has  changed ');
            if( !is_null($attribute)){
                // yii::error($attribute);
                 //yii::error(array_keys($this->dateorTimeFields));
               if(in_array($attribute,array_keys($this->dateorTimeFields))){ 
                  // yii::error('es fecha');
                   return $this->hasChangeTimeField($attribute) ;
                }else{
                   //yii::error('No ees fecha');  
                }
                 
                 return (!($this->{$attribute}==$this->getOldAttribute($attribute)));
        
            }else{
                $changed=false;
                foreach($this->attributes as $attribute=>$value){
                    if($this->hasChanged($attribute)){$changed=true;break;}
                }
                return $changed;
            }
          }
        
        
        
        
        /*
         * Esta funcion , compara un campo 
         * fecha en formatos originales de la BD
         * de tal modo que detecta el VERDADERO cambio del 
         * campo. Sabiendo que existe un cambio falso 
         * que ocasionba la funcion prepareTimeFields()
         * al ejecutarse  cada vez que el modelo presenta
         * estos campos con le evento afterfind();
         */
        private function hasChangeTimeField($attribute){ 
           // yii::error('Atributo '.$attribute);
            //yii::error('VAlor del Atributo '.$this->{$attribute});
           // yii::error(static::_FORMATBD);
           // yii::error($this->dateorTimeFields[$attribute]);
           //yii::error($this->gsetting(static::_FORMATBD, $this->dateorTimeFields[$attribute]));
          
          /* $oldformat=Yii::$app->formatter->dateFormat;
           // yii::error($oldformat);
         Yii::$app->formatter->datetimeFormat =
       'php:'.$this->gsetting(static::_FORMATBD, $this->dateorTimeFields[$attribute]);
       //yii::error(Yii::$app->formatter->dateFormat );
       yii::error('**********seguimiento***************' ); 
       yii::error('campo' ); 
       yii::error($attribute); 
        yii::error('gsetting('.static::_FORMATBD.' , '.$this->dateorTimeFields[$attribute].'))' ); 
       yii::error($this->gsetting(static::_FORMATBD, $this->dateorTimeFields[$attribute]));
       yii::error('Valor del campo' ); 
       yii::error($this->{$attribute} );
       yii::error('Fromato de la fecha a aplicar ' );
        yii::error($this->dateorTimeFields[$attribute] );
        
         $currentValue= Yii::$app->formatter->format(
                            $this->{$attribute}, 
                         $this->dateorTimeFields[$attribute]
                         );
        $originalValue=$this->getOldAttribute($attribute);
                  yii::error('valor actual');
          yii::error('Yii::app->formatter->format('.$this->{$attribute}.','.$this->dateorTimeFields[$attribute].')');  
                  yii::error($currentValue);
                  yii::error('valor anterior');yii::error($originalValue);
              Yii::$app->formatter->dateFormat=$oldformat;
              yii::error('********Fin*************');
                return (!($currentValue==$originalValue));  */
            
            $originalValue=$this->getOldAttribute($attribute);
            $currentValue=$this->{$attribute};
            //yii::error('--compronado si originalValue ('.$originalValue.') =  currentValue('.$currentValue.' )');
              if($originalValue==$currentValue){
                 // yii::error('Si;    son iguales.   Esto quiere decir que no ha cambiado');
                  return false;
              }else{
                  // yii::error('No;  No  son iguales.  Pero aun falta determinadar si solo es una diferencia de transformacion de formatos: ');
                   //yii::error('if( $this->swichtDate($attribute,false)==$originalValue) ');
                  //yii::error('if( "'.$this->swichtDate($attribute,false).'"=="'.$originalValue.'"  ) ');
                  
                  if($this->swichtDate($attribute,false)==$originalValue){
                    // yii::error('Si;  eran iguales.  Soloq ue se habian transformado');
                    return false;
                  }else{
                    // yii::error('No;  No  son iguales.  El campo ha sido modificado');
                   
                      return true;
                  }
                    
                   
                  
              }
             // yii::error($currentValue);
             //yii::error($originalValue);
            // return (!($currentValue==$originalValue)); 
        }
        
        
        /*Funcion que convierte un formato dado en 
         * formatos válidos para el objeto DateTime de PHP
         * o el parámetro $format de la funcion createfromFormat($format) de CARBON 
         * 
         */
        public static function  getGeneralFormat($format,$type,$show){
            $expresion="/[^a-zA-Z0-9]/";   
            preg_match($expresion,$format,$valores);
            $delimiter=$valores[0]; 
            //yii::error('los valores :'. serialize(explode($delimiter,$format)));
            $ygriega='Y';
            $mes='m';
            $dia='d';
            
            /*Aca de acuerdo al formato aceptado del objeto DateTime de php */
            foreach(explode($delimiter,$format) as $clave=>$valor){
                if($valor==='yy' && $show){$ygriega='y';} ///Año de dos digitos   
                if($valor==='m' && $show){$mes='n';} // mes de un digito sin cero adelante
                if($valor==='d' && $show){$dia='j';}  // dia de un digito sin cero adelante 
            }
            // $format= $this->gsetting($key, $type);
            if(strtolower(substr(trim($format),0,1))=='d'){
                if($type==static::_FDATE)return $dia.$delimiter.$mes.$delimiter.$ygriega;
                if($type==static::_FDATETIME)return $dia.$delimiter.$mes.$delimiter.$ygriega.' H:i:s';
                if($type==static::_FTIME)return 'H:i:s';
                if($type==static::_FHOUR)return 'H:i';
            }
            if(strtolower(substr(trim($format),0,1))=='y'){
                if($type==static::_FDATE)return $ygriega.$delimiter.$mes.$delimiter.$dia;
                if($type==static::_FDATETIME)return $ygriega.$delimiter.$mes.$delimiter.$dia.' H:i:s';
                if($type==static::_FTIME)return 'H:i:s';
                 if($type==static::_FHOUR)return 'H:i';
            }
            
            /*sI SE TRATARA DE UN TIME */
             if(strtolower(substr(trim($format),0,1))=='h' ){               
                if($type==static::_FTIME)return 'H:i:s';
                 if($type==static::_FHOUR)return 'H:i';
            }
           
        }
        
        private static function reverseKey($key){
            if($key==static::_FORMATUSER)return static::_FORMATBD;
            if($key==static::_FORMATBD)return static::_FORMATUSER;
              
        }
        
        
        public  static function  firstOrCreateStatic($attributes,$scenario=null,$verifyAttributes=null){  
          
            //print_r($attributes);
            //$model=self::find()->where($attributes)->one();
            $myAttributesVerify=(is_null($verifyAttributes))?$attributes:$verifyAttributes;
            //yii::error($myAttributesVerify); 
            //yii::error($myAttributesVerify);
           // echo self::find()->andWhere($myAttributesVerify)->createCommand()->getRawSql();die();
            if(!(self::find()->andWhere($myAttributesVerify)->exists())){
                         //yii::error($myAttributesVerify);       

                try{
                    $clase= static::class;
                    $model=new $clase;
                    if(!is_null($scenario))
                        $model->setScenario($scenario);
                    //$model->oldAttributes=[];
                   // echo $model->getScenario();die();
                       $model->attributes=$attributes;
                       //print_r($model->attributes);die();
                       
                 IF(!$model->save()){
                     //echo "fallo";die();
                    // print_r($model->getErrors());die();
                     yii::error($model->getErrors(),__METHOD__);
                     // print_r($model->getErrors());die();
                     return false;
                 }
                   // print_r($model->getErrors());die();
                    unset($model);
                    //echo "ok  ----->";
                        return true;
                } catch (\yii\db\Exception $exception) {
                    yii::error($exception->getMessage());
                  //  echo "    --->  error  :    ". $exception->getMessage();
                     return false;
             } 
                
            } else{
               yii::error('ya  existe');
                return false;
            }
            
        }
        
        public  function  firstOrCreate($attributes,$scenario=null,$verifyAttributes=null){  
            //print_r($attributes);
            $myAttributesVerify=(is_null($verifyAttributes))?$attributes:$verifyAttributes;
              if(!(self::find()->andWhere($myAttributesVerify)->exists())){
                         //yii::error($myAttributesVerify);       

                try{
                   // $clase= static::class;
                   // $model=new $clase;
                    if(!is_null($scenario))
                        $this->setScenario($scenario);
                    //$model->oldAttributes=[];
                   // echo $model->getScenario();die();
                       $this->attributes=$attributes;
                       //print_r($model->attributes);die();
                       
                 IF(!$this->save()){
                     //echo "fallo";die();
                    // print_r($model->getErrors());die();
                     yii::error($this->getErrors(),__METHOD__);
                     // print_r($model->getErrors());die();
                     return false;
                 }
                   // print_r($model->getErrors());die();
                    unset($model);
                    //echo "ok  ----->";
                        return true;
                } catch (\yii\db\Exception $exception) {
                    yii::error($exception->getMessage());
                  //  echo "    --->  error  :    ". $exception->getMessage();
                     return false;
             } 
                
            } else{
               yii::error('ya  existe');
                return false;
            }
        }
        
   
    public  function maxValue($field,$campocriterio=null){
        if(is_null($campocriterio))
            return self::find()->max($field);
            return self::find()->where([$campocriterio=>$this->{$campocriterio}])->max($field);
    }  
    
    public function getFieldSize($field){
        /*var_dump($this->getDb()->
                schema->getTableSchema($this->tableName())->
                getColumn($field)->size);die();*/
             return   $this->getDb()->
                schema->getTableSchema($this->tableName())->
                getColumn($field)->size;
    }
    
    public function correlativo($field,$longitud=null,$campocriterio=null){
        /*verificando la longitud con el tamaño del campo
         * */
        $tamano=$this->getFieldSize($field);
         //var_dump($longitud);die();
        if(!is_null($longitud))
        if($tamano > $longitud){
           $tamano=$longitud;
        }
       // var_dump($tamano);
        
        /*Si el campo criterio es diferente a null*
         * Se reemplaza por preijo
         */
           if(!is_null($campocriterio))
                $this->prefijo=$this->{$campocriterio};      
         /*
         * Si el prefijo es <> null se sigue achicando el tamano
         */
           if(!is_null($this->prefijo)){
               
                            $diferenciatamano=$tamano-strlen(trim($this->prefijo));
                            
                          if($diferenciatamano < 4){
                              //si es menor que 4 o es negativa, dejar el taaño com es y no aplicar el prefijo
                         $this->prefijo="1";
                         $tamano=$tamano-1;
                         
                              }else{
                                  
                              $tamano=$diferenciatamano;
                             // VAR_DUMP($tamano) ;DIE();
                          }
              }else{
                  //ECHO "PREFIJO NULL";DIE();
                          $this->prefijo="";
             }
              
                                
        $maximus=self::maxValue($field,$campocriterio);
        if(is_null($maximus) or empty($maximus)){           
            $maximus=1;
             return $this->prefijo.str_pad($maximus,$tamano,'0',STR_PAD_LEFT);
             }else{
                 
           $maximus=$maximus+1; 
           //aqui sin el prefijo porque ya esta calculado
            return str_pad($maximus,$tamano,'0',STR_PAD_LEFT);
                 //return $this->addOneValue($maximus, $tamano, $this->prefijo);
        }
        
       
       // var_dump($maximus);
       // var_dump($tamano);die();
       
    }
    
    /*private function addOneValue($maximus,$tamano,$prefijo){
        $valor= substr($maximus, strlen($maximus)-$tamano)+0;
        $valor=($valor+1).'';
        return $prefijo.str_pad($valor,$tamano,'0',STR_PAD_LEFT);
    }
    */
    public function getFirstError($attribute=null) {
        if(is_null($attribute)){
            if($this->hasErrors()){
               foreach($this->getErrors() as $clave=>$valor){
                   $mensaje=$valor[0];break;
               }
               return $clave.":".$mensaje;
            }ELSE{
                RETURN "";
            }
        }ELSE{
          parent::getFirstError($attribute);  
        }
        
    }


    /**
     * Get available and assigned routes
     * @return array
     */
    public function getRoutes()
    {
        //$manager = Configs::authManager();
        // Get advanced configuration
       // var_dump(Configs::instance()->advanced);die();
        $advanced = false;
        if ($advanced) { 
            // Use advanced route scheme.
            // Set advanced route prefix.
            $this->_routePrefix = static::PREFIX_ADVANCED;
            // Create empty routes array.
            $routes = [];
            // Save original app.
            $yiiApp = Yii::$app;
            // Step through each configured application
            foreach ($advanced as $id => $configPaths) {
                // Force correct id string.
                $id = $this->routePrefix . ltrim(trim($id), $this->routePrefix);
                // Create empty config array.
                $config = [];
                // Assemble configuration for current app.
                foreach ($configPaths as $configPath) {
                    // Merge every new configuration with the old config array.
                    $config = yii\helpers\ArrayHelper::merge($config, require (Yii::getAlias($configPath)));
                }
                // Create new app using the config array.
                unset($config['bootstrap']);
                $app = new yii\web\Application($config);
                // Get all the routes of the newly created app.
                $r = $this->getAppRoutes($app);
                // Dump new app
                unset($app);
                // Prepend the app id to all routes.
                foreach ($r as $route) {
                    $routes[$id . $route] = $id . $route;
                }
            }
            // Switch back to original app.
            Yii::$app = $yiiApp;
            unset($yiiApp);
        } else {
            // Use basic route scheme.
            // Set basic route prefix
            $this->_routePrefix = static::PREFIX_BASIC;
            // Get basic app routes.
            $routes = $this->getAppRoutes();
           
        }
        $exists = [];
       // var_dump($manager->getPermissions());die();
       /* foreach (array_keys($manager->getPermissions()) as $name) {
            if ($name[0] !== $this->routePrefix) {
                continue;
            }
            $exists[] = $name;
            unset($routes[$name]);
        }*/
        return [
            'available' => array_keys($routes),
            'assigned' => $exists,
        ];
    }

    /**
     * Get list of application routes
     * @return array
     */
    public function getAppRoutes($module = null)
    {
        if ($module === null) {
            $module = Yii::$app;            
        } elseif (is_string($module)) {
            $module = Yii::$app->getModule($module);
        }
        $key = [__METHOD__, Yii::$app->id, $module->getUniqueId()];
       
       // $cache = Configs::instance()->cache;
        //var_dump(Configs::instance()->cache);die();
        //if ($cache === null || ($result = $cache->get($key)) === false) {
           // $result = [];
            
               //echo get_class($module)."<br>";
              
            $this->getRouteRecursive($module, $result);
            //print_r($result);die();
            /*if ($cache !== null) {
                $cache->set($key, $result, Configs::instance()->cacheDuration, new TagDependency([
                    'tags' => self::CACHE_TAG,
                ]));
            }*/
       // }
      
        return $result;
    }

    /**
     * Get route(s) recursive
     * @param \yii\base\Module $module
     * @param array $result
     */
    protected function getRouteRecursive($module, &$result)
    {
        $token = "Get Route of '" . get_class($module) . "' with id '" . $module->uniqueId . "'";
      // echo $token."<br>";
        Yii::beginProfile($token, __METHOD__);
        try {
           // print_r(array_keys($module->getModules()));echo "<br>";
            foreach ($module->getModules() as $id => $child) {
               if (($child = $module->getModule($id)) !== null) {
                    //echo "modulo hijo ".$child."<br>";
                    $this->getRouteRecursive($child, $result);
                    
                }
               // $child = $module->getModule($id);
               // echo "el id ".$id."<br>";
            }
     //echo "saliendo<br>";
            foreach ($module->controllerMap as $id => $type) {
                
                $this->getControllerActions($type, $id, $module, $result);
            }

            $namespace = trim($module->controllerNamespace, '\\') . '\\';
            //echo get_class($module)." --> ".$namespace."<br>";
            $this->getControllerFiles($module, $namespace, '', $result);
            $all = '/' . ltrim($module->uniqueId . '/*', '/');
            $result[$all] = $all;
           // echo  get_class($module)."<br>";
        } catch (\Exception $exc) {
           // Yii::error($exc->getMessage(), __METHOD__);
        }
        Yii::endProfile($token, __METHOD__);
    }

    /**
     * Get list controller under module
     * @param \yii\base\Module $module
     * @param string $namespace
     * @param string $prefix
     * @param mixed $result
     * @return mixed
     */
    protected function getControllerFiles($module, $namespace, $prefix, &$result)
    {
        $path = Yii::getAlias('@' . str_replace('\\', '/', $namespace), false);
        $token = "Get controllers from '$path'";
        Yii::beginProfile($token, __METHOD__);
        try {
            if (!is_dir($path)) {
                return;
            }
            foreach (scandir($path) as $file) {
                if ($file == '.' || $file == '..') {
                    continue;
                }
                if (is_dir($path . '/' . $file) && preg_match('%^[a-z0-9_/]+$%i', $file . '/')) {
                    $this->getControllerFiles($module, $namespace . $file . '\\', $prefix . $file . '/', $result);
                } elseif (strcmp(substr($file, -14), 'Controller.php') === 0) {
                    $baseName = substr(basename($file), 0, -14);
                    $name = strtolower(preg_replace('/(?<![A-Z])[A-Z]/', ' \0', $baseName));
                    $id = ltrim(str_replace(' ', '-', $name), '-');
                    $className = $namespace . $baseName . 'Controller';
                    if (strpos($className, '-') === false && class_exists($className) && is_subclass_of($className, 'yii\base\Controller')) {
                        $this->getControllerActions($className, $prefix . $id, $module, $result);
                    }
                }
            }
        } catch (\Exception $exc) {
            //Yii::error($exc->getMessage(), __METHOD__);
        }
        Yii::endProfile($token, __METHOD__);
    }


  /* Esta funcion ocnveirte el valor de '1' en true
   * utril para campos que leen en labase d edatos 
   * ='1' en lugar de booleanos 
   */
    private function convertBooleanFields($out=true){//
        if($out){
           foreach ($this->booleanFields as $key=>$nameField){
               //var_dump($this->{$nameField});
            $this->{$nameField}=($this->{$nameField}=='1')?true:false;
            }  
        }else{
            foreach ($this->booleanFields as $key=>$nameField){
               // if(gettype($this->{$nameField}))
                
            $this->{$nameField}=($this->{$nameField})?'1':'0';
            }  
        }
       
    }
    
    /*Devuelve el primer campo Safe
     * de un respectico escenario
     */
    public function firstSafedAttribute(){
        $campo=null;
        foreach($this->attributes() as $name=>$value){
            if($this->isAttributeSafe($name)){
                $campo=$name;
                break;
            }
        }
      return $campo;
    }
   
    /*
     * Obtiene un array de campos que no podrían ser editados 
     * requisitos para ser campo bloqueado:
     * isblockedField()
     */
    public function  blockedFields(){
        $bloqueados=[];
        
         foreach($this->attributes as $name=>$valor){
             //echo "registrando  ".$name."<br>";
            // var_dump($name);
            if($this->isBlockedField($name)){
               // echo "cayo  ".$name."<br>";
               $bloqueados[]=$name; 
            }
             
        }
       return $bloqueados;
    }
    
    
    /*
     * Retorna una regla para todos los campos
     * bloqueados para que no  peudasn editar
     * teniendo registros hijos sensibles
     */
    public function ruleBlockedFields(){
    return [
           // [$this->blockedFields(),'required'],
            [$this->blockedFields(),'validateBlockedField','skipOnError' => false],
            
           ];
       
        
    }
    
    /*Regla de validacion para la funcion ruleBlocked Fields
     * ¿Debe ser private??  pruebalo ...
     */
    public function validateBlockedField($attribute, $params){
            if ($this->hasChanged($attribute) ) {
                $this->addError($attribute,yii::t('base_errors','The field "{namefield}" can\'t be modified, other records depend on it',['namefield'=>$attribute]));
            }
    }
    
   /*.
    * 
    * Obtiene una instancia de Carbon pasando
    * un NOMBRE DE UN campo del objeto
     */
    public function toCarbon($attribute){
        
         if (!in_array($attribute, 
                 array_keys($this->dateorTimeFields))){
            throw new ServerErrorHttpException(Yii::t('base_errors', 'Wrong property {valor}  in field time {campo} Times  ',['campo'=>$attribute])); 
         }
         
         $type=$this->dateorTimeFields[$attribute];
         $formato=$this->formatToCarbon($type);
          return Carbon::createFromFormat(
                     $formato,
                      $this->{$attribute});
                      
                      
         //yii::$app->settings->invalidateCache();
         /* if($this->dateorTimeFields[$attribute]==static::_FDATE)
              return Carbon::createFromFormat(
                      $this->getGeneralFormat($this->gsetting(static::_FORMATUSER, static::_FDATE),static::_FDATE,true),
                      $this->{$attribute});
           if($this->dateorTimeFields[$attribute]==static::_FDATETIME)
              return Carbon::createFromFormat(
                    $this->getGeneralFormat($this->gsetting(static::_FORMATUSER, static::_FDATETIME),static::_FDATETIME,true),
                      $this->{$attribute});
            if($this->dateorTimeFields[$attribute]==static::_FTIME)
                //echo $this->getGeneralFormat($this->gsetting(static::_FORMATUSER, static::_FTIME),static::_FTIME,true);die();
              return Carbon::createFromFormat(
                     $this->getGeneralFormat($this->gsetting(static::_FORMATUSER, static::_FTIME),static::_FTIME,true),
                      $this->{$attribute});
            if($this->dateorTimeFields[$attribute]==static::_FHOUR)
              return Carbon::createFromFormat(
                    $this->getGeneralFormat($this->gsetting(static::_FORMATUSER, static::_FHOUR),static::_FHOUR,true),
                      $this->{$attribute});*/
                   
          
           }
     
           /*
            * FUNCION QUE DEVUL EL FORMATO LISTO 
            * PARA INSTANCIAR UN OJETO CARBON
            * var : $type  puede ser   'date' (self::_FDATE)  , 'dateTime' (self::_FDATETIME),  'time' (self::_FTIME)  , 'hour' (self::_HOUR)
            */
     public function formatToCarbon($type){
         if (!in_array(
                 $type, 
                 [self::_FDATE,self::_FDATETIME,SELF::_FTIME,SELF::_FHOUR ]
                 )
             ){
            throw new ServerErrorHttpException(Yii::t('base_errors', 'El tipo {tipo}  es inválido, tiene que ser '
                    . '\'{fdate}\' o \'{fdatetime}\' o \'{fhour}\' o \'{ftime}\'  ',['tipo'=>$type,
                        'fdate'=>self::_FDATE,
                        'fdatetime'=>self::_FDATETIME,
                        'fhour'=>self::_FHOUR,
                        'ftime'=>self::_FTIME,
                        ])); 
         }
              return  $this->getGeneralFormat(
                      $this->gsetting(static::_FORMATUSER, $type),
                      $type,true);
     }      
           
           
      public static function CarbonNow(){
          return Carbon::now();
      }
              
           
  /*
   * Obtiene una coleccion de clases modelos (strings)
   * relacionados ; pero aguas arriba (hasOne) 
   * return  array(nombrescortos=>nombreslargos)
   */        
  public function parentModels(){
     return $this->modelsByRelations(true);
  }
  /*
   * Obtiene una coleccion de clases modelos (strings)
   * relacionados ; pero aguas abajo (hasMany) 
   * return  array(nombrescortos=>nombreslargos)
   */ 
  public function childModels(){
      return $this->modelsByRelations(false); 
  }
  
  private function modelsByRelations($parents=true){
     $arre=$this->fillRelations();
    // yii::error($arre);
      $modelos=[];
      foreach($arre as $clases=>$valores){
          if($valores[1]){//si son hijos 
              if($parents===false) //si se indinca hijos
                   $modelos[FileHelper::getShortName($clases)]=$clases; 
          }else{//son padres
              if($parents) //si se indnica padres
                  $modelos[FileHelper::getShortName($clases)]=$clases; 
          }         
             
      }
      return $modelos;
  }
     
  
  public function comboValores($field){
      if(!in_array($field, array_keys($this->fakeRelations)))
       return false;  
      
  }
  
  /*FUNCION ABREVIADA PARA USAR LA FUNCION 
   *  setFormatTimeFromSettings() 
   * coN DENOMIANCION MAS CORTA 
   * EN RELAIDA HACE LLOO MISMO
   * @attribute: NOmbre del campo date
   * @show: boolean    true: Saca el formato de fecha pra el usuario  dd/mm/yy o dd.m/y  ó como lo hayan configurado
   *                   false:saca el formato para la BD
   * 
   */
  public function swichtDate($attribute,$show){
      
      return $this->setFormatTimeFromSettings($attribute,$show);
  }
  
  /*
   * Funcion que abre el borde de una fecha , esto 
   * para introducirla en la sentencia  between de SQL 
   * @attribute: NOmbre del campo fecha 
   * @up: Boolean    true: añade (+) , false  quita (-)
   * Asi pòr ejemplo : (+) 23/05/2019  => 24/05/2019  agrega un dia
   *                   (-)  15/04/2018   =>16/04/2018  disminuye un dia
   *                   (+) 23/05/2019 15:45:23 => 23/05/2019 15:45:24 AGREGA UN MILISEGUNDO
   *                   (+) 15:45:23 =>  15:45:24 AGREGA UN MILISEGUNDO
   * @show : Boolean   true:  en formato para ususrio yy/mm/dd  false en forato para DB  Y-m-d       
   *  return : STRING una cadea foramteada de fecha en formato  Y-m-d
   *   */
  public function openBorder($attribute,$up=true){
      $type=$this->dateorTimeFields[$attribute];
      if($type==static::_FDATE)
          return($up)?$this->toCarbon($attribute)->addDay()->toDateString():
                      $this->toCarbon($attribute)->subDay()->toDateString();
          
      if($type==static::_FDATETIME )
        return($up)?$this->toCarbon($attribute)->addSecond()->toDateTimeString():
                      $this->toCarbon($attribute)->subSecond()->toDateTimeString();
         
      if($type==static::_FTIME)
        return($up)?$this->toCarbon($attribute)->addSecond()->toTimeString():
                      $this->toCarbon($attribute)->subSecond()->toTimeString();
         
       if($type==static::_FHOUR)
        return($up)?$this->toCarbon($attribute)->addSecond()->toTimeString():
                      $this->toCarbon($attribute)->subSecond()->toTimeString();
      
     
         }
  
         
 
  public static function getShortNameClass(){
     
        $retazos=explode('\\',self::className());
        // return $retazos;
      return $retazos[count($retazos)-1];
  }
  
/*Esta funcion devuelve una array con los posibles
 * campos "buscables" , indice el nombre del campo => valores el tamaño del campo
 * en la base de datos sizeField() por ejemlo 
 * en tabla empresas devolvería: ['despro'=>40 ]
 * en la tabla trabajadores devolveria : ['nombres'=>40, 'ap'=>35, 'am'=>35]
 * Util cuando se busca un valor por un  codigo , en espcial lo usaran los widgets 
 * 
 */
  public function possibleSearchables(){
      $arrayCampos=[];
      $obCampos=$this->getTableSchema()->columns;
      foreach($obCampos as $nombrecampo=>$obCampo){
          if($obCampo->size > 20 && is_string($this->{$nombrecampo})){
             $arrayCampos[$nombrecampo]=$obCampo->size; 
          }
          
      }
      unset($obCampos);
      arsort($arrayCampos);//ordernar por tamaño descendentemente
      if(count($arrayCampos)>2){
         array_slice($arrayCampos,-(count($arrayCampos)-2));
      }
      
      
      return $arrayCampos;
  }
  
  /*
   * Devuelve el nombre de la tabla de la base de dartos pero sine l prefijo
   * Es una lastima  que el framework no lo tenga como funcion nativa en el SchemaBuilder
   */
  public static function RawTableName(){
     return str_replace('}}','', str_replace('{{%','',static::tableName()));
  }
  
  
  
  /*public function  addDay($fieldDate){
      return $this->toCarbon($fieldDate)->addDay();
  }
  public function  addDay($fieldDate){
      return $this->toCarbon($fieldDate)->addDay();
  }
  */
  
  
  /*
   * Devuelve unalista de valores de la tablacombo vlaores , registrada 
   * para este  campo, si nel campo no esta registrado co una lista de valores ,
   *  devuelve un array vacio 
   */
        public static function comboDataField($attribute,$codcentro=null){
           return \common\helpers\ComboHelper::getTablesValues(static::RawTableName().'.'.$attribute,$codcentro=null);
           
        }
        
        
        public static function comboValueFieldStatic($attribute,$valor=null,$codcentro=null){
           //echo static::RawTableName().'.'.$attribute;return;
           return \common\models\masters\Combovalores::getValue(static::RawTableName().'.'.$attribute,$valor,$codcentro);
           
        }
        
    /*
   * Devuelve 
     * el valor denominacion del camo relacionado conl a tala combos 
   */
        public  function comboValueField($attribute,$codcentro=null){
            $valor=$this->{$attribute};
           return \common\models\masters\Combovalores::getValue(static::RawTableName().'.'.$attribute,$valor,$codcentro);
           
        }
        
      /*Devuelve un array de campos coemnzando por los indices de
       * la tabla
       */
        public function  getSafeFields(){
            //$safe= array_intersect($this->primaryKey();
            $safe=[];
            foreach($this->attributes as $nombre=>$valor){
                if($this->isAttributeSafe($nombre)){
                   $safe[]=$nombre; 
                }
            }
           
         return $safe;   
         
        }
      /*verifica si el modelo tiene adjuntos
       * Leyendo la proeidad files;
       * Recordar que la propiedad files (array), existe
       * siempre que el modelo tenga el behavior  attachments 
       * Si ademas lo tuviera files tiene que tener por lo menos
       * un elemento 
       */
        public function hasAttachments(){
            try{
                //Intenta leer la propiedad  files 
                $adjuntos=$this->files;
                return (count($adjuntos)>0)?true:false;
                //unset($adjuntos);return true;
            } catch (\Exception $exception) {
                
                return false;
            }
            
        }  
     
    
      /*
       * Esta funcion asigna el valor del formato 
       * de usuario   yy/mm/dd  m.d.YYY o el que haya conigurado  en settings
       * brindando el formato de fecha PHP 
       * muy útil cuando se desea ingresar fechas mediante
       * código sin usar los imputs validadores como 
       * el JUICALENDAR u otros 
       * 
       * @field : Nombre del campo , tiene que estar dentro del array dateorTimeFields
       * @dateV: Valor de la fecha o tiempo en formato PHP crudo
       * 
       * intenamente asigna al campo $field ,el string equivalente
       * a la fecha php 
       * por ejemplo: 
       * 
       * $model->rawToUser('mifecha',date('Y-m-d H:i:s'));
       * internamente hace esto :
       *      $model->mifecha='14/10/2019 23:45:32' 
       * Esto para que cuendo grabe el campo se conveirta nuevamente
       * en  el valor crudo original, respectando las conversiones del modelo
       * 
       * 
       * 
       */  
    public function rawDateUser($field,$dateV=null){
        if(is_null($dateV)){
            $dateV=date('Y-m-d H:i:s');
        }
        $this->{$field}=$dateV;
        $this->{$field}=$this->swichtDate($field,true);  
        return true;
    }
        
  public function addMessage($category=self::MESSAGE_ERROR,$message){
       $this->_messages[$category][]=$message."\n";
       return true;
  } 
  public function flushMessages($category=null){
      if($category===null)
          $this->_messages=[];
       $this->_messages[$category]=[];
       return true;
  }
public function messagesForCategory($category){
     if(array_key_exists($category,$this->_messages))
             throw new ServerErrorHttpException(Yii::t('base_errors', 'The requested category {cat} does not exist in the messages array',['cat'=>$category]));  
     return $this->_messages[$category];
}
public function messages(){
  return $this->_messages;  
}
public function firstMessage($category=null){
   if($category===null){
     if(count($this->_messages[self::MESSAGE_ERROR])>0)
    return $this->_messages[self::MESSAGE_ERROR][0];
    if(count($this->_messages[self::MESSAGE_WARNING])>0)
         return $this->_messages[self::MESSAGE_WARNING][0];
    if(count($this->_messages[self::MESSAGE_SUCCESS])>0)
         return $this->_messages[self::MESSAGE_SUCCESS][0];      
       return '';  
   }else{
       if(array_key_exists($category,$this->_messages)){
            if(count($this->_messages[$category])>0)
              return $this->_messages[$category][0];  
               return '';
       }else{
         throw new ServerErrorHttpException(Yii::t('base_errors', 'The requested category {cat} does not exist in the messages array',['cat'=>$category]));  
       }
         
   }
    
  }  
  
  
  public static function listMailFromField($attribute,$condition=[1=>1]){
      if(in_array($attribute,static::$mailFields)){
         return array_column(static::find()->select($attribute)->
            where($condition)->
            // andWhere(['<>',$attribute,null])->
              andWhere(['<>',$attribute,''])->asArray()->all(),$attribute);
          
      }else{
         throw new ServerErrorHttpException(Yii::t('base_errors', 'The field {campo} does not belong to the mail field list',['campo'=>$attribute]));  
      }
  }
  
  /*
   * Copia los valores de lso campos relacionados
   * del modelo 
   * un modelo padre al modelo actual
   */
  public function putValuesFromParent ($model){
     
      $camposLink=$this->fieldsLink(false); //sOLO PADRE SO UNO A UNO
      //var_dump($camposLink,$model::className());die();
      foreach($camposLink as $nombrecampo=>$nombreClase){
          $campoForaneo=$this->obtenerForeignField($nombrecampo);
          
          IF($model->hasProperty($campoForaneo)) {
         $this->{$nombrecampo}=$model->{$campoForaneo};
      }
  } 
  
  }   
}   


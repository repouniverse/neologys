<?php

namespace frontend\modules\import\models;
use frontend\modules\import\models\ImportCargamasiva;
use frontend\modules\import\ModuleImport as m;
use frontend\modules\import\components\CSVReader as MyCSVReader;
use common\behaviors\FileBehavior;
//use frontend\modules\import\behaviors\FileBehavior;
use common\helpers\timeHelper;
use common\helpers\h;
use Yii;
use yii\db\Query;

/**
 * This is the model class for table "{{%import_carga_user}}".
 *
 * @property int $id
 * @property int $cargamasiva_id
 * @property string $fechacarga
 * @property int $user_id
 * @property string $descripcion
 * @property int $current_linea
 * @property int $total_linea
 * @property string $tienecabecera
 * @property string $duracion
 *
 * @property ImportCargamasiva $cargamasiva
 */
class ImportCargamasivaUser extends \common\models\base\modelBase
{
    const STATUS_ABIERTO='10';
    const STATUS_PROBADO='20';
    const STATUS_CARGADO_INCOMPLETO='30';
    const STATUS_CARGADO='40';
     const STATUS_PROBADO_ERRORES='60';
    
    
    
    const STATUS_COMPLETO='50';
    const SCENARIO_STATUS='status';
    const SCENARIO_MINIMO='minimo';
    const SCENARIO_RUNNING='running_load';
   public $_csv=null;  //OBJETO CSVREADER
   public $hasFile=false;
    /**
     * {@inheritdoc}
     */
    public $booleanFields=['tienecabecera'];
    public $dateorTimeFields=['fechacarga'=>self::_FDATETIME];
    //=['fecingreso'=>self::_FDATE,'cumple'=>self::_FDATE];
    public function init(){
        //$this->current_linea=0;
        $this->total_linea=0;
    }
    public static function tableName()
    {
        return '{{%import_carga_user}}';
    }

    public function behaviors()
        {
	return [
		
		'fileBehavior' => [
			'class' => FileBehavior::className()
		]
		
	];
            }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cargamasiva_id', 'descripcion'], 'required'],
            [['user_id'], 'safe'],
            [['cargamasiva_id', 'user_id', 'current_linea', 'total_linea'], 'integer'],
            [['fechacarga'], 'string', 'max' => 19],
            [['descripcion', 'duracion'], 'string', 'max' => 40],
           // [['tienecabecera'], 'string', 'max' => 1],
            [['cargamasiva_id'], 'exist', 'skipOnError' => true, 'targetClass' => ImportCargamasiva::className(), 'targetAttribute' => ['cargamasiva_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => m::t('labels', 'ID'),
            'cargamasiva_id' => m::t('labels', 'Bulk Load Id'),
            'fechacarga' => m::t('labels', 'Date'),
            'user_id' => m::t('labels', 'User Id'),
            'descripcion' => m::t('labels', 'Description'),
            'current_linea' => m::t('labels', 'Line'),
            'total_linea' => m::t('labels', 'Total Line'),
            'tienecabecera' => m::t('labels', 'Headboard'),
            'duracion' => m::t('labels', 'Duration'),
            'hasFile' => m::t('labels', 'Attached'),
        ];
    }

     public function scenarios()
    {
        $scenarios = parent::scenarios(); 
        $scenarios[self::SCENARIO_MINIMO] = ['user_id','cargamasiva_id','descripcion','tienecabecera','current_linea_test','activo'];
        $scenarios[self::SCENARIO_STATUS] = ['activo'];
        $scenarios[self::SCENARIO_RUNNING] = ['user_id','activo','current_linea','total_linea','current_linea_test','fechacarga'];
 $scenarios['fechita'] = ['fechacarga'];
        return $scenarios;
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCargamasiva()
    {
        return $this->hasOne(ImportCargamasiva::className(), ['id' => 'cargamasiva_id']);
    }

    /**
     * {@inheritdoc}
     * @return ImportCargaUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ImportCargamasivaUserQuery(get_called_class());
    }
    
    public function getCsv(){
     //var_dump($this->firstLineTobegin());die();
        yii::error('primera linea para importar:  '.$this->firstLineTobegin(),__METHOD__);
      if(is_null($this->_csv)){
         
          $this->_csv= New MyCSVReader( [
                 'filename' => $this->pathFileCsv(),
              'startFromLine' =>$this->firstLineTobegin(),
                 'fgetcsvOptions' => [ 
                                     'delimiter' => h::gsetting('import', 'delimiterCsv'),
                                       ] 
                                ]);
          return $this->_csv;
      }else{
       return $this->_csv;   
      }
    }
    
    public function firstLineTobegin(){
        if($this->current_linea==0 && $this->cargamasiva->tienecabecera)
            return 2;
         if($this->current_linea==0 && !$this->cargamasiva->tienecabecera)
            return 1;
         return $this->current_linea + 1 ;
        
    }
    
    /*
     * Obtiene el array de datos a cargar, lee 
     * el archivo csv de disco 
     * USa la libreria MyCSVrEADER , que no es nada del otro mundo
     * solo para ahora trabajo de leer un formato csv 
     */
    public function dataToImport(){
      yii::error('comenzando a leer el csv',__METHOD__);
      $datos= $this->csv->readFile();
      $this->total_linea=count($datos);
      return $datos;
  } 
    
   /*Retorna la ruta a un archivo csv adjunto (El primero) 
    * Hace uso del  behavior FileBehavior , que es una clase extendida(
    * con la funcion nueva getFilesByExtension() que devuelve
    * archivos adjuntos filtrados por la extension  */
     
      public function pathFileCsv(){
    $registros=$this->getFilesByExtension(ImportCargamasiva::EXTENSION_CSV);
    
    if(count($registros)>0){
        return $registros[0]->getPath();
    }else{
        $this->addError('activo',m::t('import.errors','There is no attached file to import'));
         //throw new \yii\base\Exception(m::t('import.errors', 'No hay ningún archivo csv adjunto'));
     
    } 
       
   }
   
   
   /*
   * Verifica que la estrucutra de las columnas
   * del csv coinciden 'en forma' con los campos especificados hijos 
   * detectando posibles incositencas en el formato 
   * @row: Una fila del archivo csv (es una array de valores devuelto por la funcion fgetcsv())
   * normalmente es la primera fila
   */
 public function verifyFirstRow(){
     ///$oldErrors=$this->getErrors();
    // $this->clearErrors();
     $row=$this->csv->getFirstRow();
     yii::error('la primera fila es ',__METHOD__);
    yii::error($row,__METHOD__);
     if(is_null($row) or $row===false)
     {
         $this->addError('activo',m::t('validaciones', 'Error; the first row of the upload file was not found, it may be that the file has no rows or the firstLineToBegin () property: {primera} I reach the end of the file',['primera'=>$this->firstLineTobegin()]));
         return false;  
     }
     $carga=$this->cargamasiva;
      if($carga->countChilds() <> count($row)){
         //throw new \yii\base\Exception(m::t('import.errors', 'The csv file has not the same number columns ({ncolscsv}) than number fields ({ncolsload}) in this load data',['ncolscsv'=>count($row),'ncolsload'=>$this->cargamasiva->countChilds()]));
       $this->addError('activo',m::t('validaciones', 'The attached load csv file has ({ncolscsv}) columns and the load template has ({ncolsload}) columns; do not match, check the attachment',['ncolscsv'=>count($row),'ncolsload'=>$this->cargamasiva->countChilds()]));
      return false;       
      }
       /*  las Filas hijas*/
      $filashijas=$carga->ChildsAsArray();
     // $countFieldsInPrimaryKey=count($this->modelAsocc()->primaryKey(true));
      $validacion=true;
     // var_dump($filashijas,$row);die();
      yii::error('comenzando  arecorrer los valores de row',__METHOD__);
      foreach($row as $index=>$valor){
          yii::error($valor,__METHOD__);
          $valor=utf8_encode($valor);
          $tipo=$filashijas[$index]['tipo'];
          $longitud=$filashijas[$index]['sizecampo'];
          $nombrecampo=$filashijas[$index]['nombrecampo'];
          $requerida=($filashijas[$index]['requerida'])?true:false;
         /*yii::error($nombrecampo);
         yii::error($tipo);
           yii::error($valor);
             yii::error($longitud);
             
             yii::error(($carga->isTypeChar($tipo)));
             yii::error(strlen($valor));
             var_dump(substr($valor,0,1),substr($valor,1,1),substr($valor,2,1),substr($valor,3,1),$valor,(integer)$longitud,strlen($valor));die();
            yii::error( ($carga->isTypeVarChar($tipo) &&($longitud < strlen($valor))));
            yii::error(($carga->isNumeric($tipo)&& (!is_numeric($valor)) ) );
            yii::error($carga->isDateorTime($tipo,$nombrecampo,$longitud));
            yii::error((
                            (strpos($valor,"-")===false) &&
                            (strpos($valor,"/")===false) &&
                             (strpos($valor,".")===false)
                          ));
         //yii::error(var_dump($tipo,$valor));
          /*Detectando inconsistencias*/
          
          $msgAdicional=m::t('validaciones','Verify that the validated row is not the file header');
           
          if($carga->isTypeChar($tipo)&&($longitud < strlen($valor))  && $requerida){
              yii::error('char: NO coindieorn las longitudes',__METHOD__);
            $this->addError('activo',m::t('validaciones', 'Longitud ({longitud}) de la columna fija "{columna}", no coincide con la longitud del valor {valor}'.$msgAdicional,['valor'=>$valor,'longitud'=>$longitud,'columna'=>$nombrecampo]));   
           $validacion=false;
            
           }
           if ($carga->isTypeVarChar($tipo) &&($longitud < strlen($valor)) && $requerida){
                yii::error('varchar: NO coindieorn las longitudes',__METHOD__);
            $this->addError('activo',m::t('validaciones', 'Longitud máxima ({longitud}) de la columna  "{columna}",es menor que la longitud del valor {valor}'.$msgAdicional,['valor'=>$valor,'longitud'=>$longitud,'columna'=>$nombrecampo]));   
           $validacion=false;
            
           }
           if($carga->isNumeric($tipo)&& (!is_numeric($valor)) && $requerida){
                yii::error('numerico : NO es el tipo',__METHOD__);
            $this->addError('activo',m::t('validaciones', 'Columna  "{columna}" es un valor numérico y  "{valor}" no lo es '.$msgAdicional,['valor'=>$valor,'columna'=>$nombrecampo]));   
           
            $validacion=false;
           }
           
          if(                  
                   $carga->isDateorTime($tipo,$nombrecampo,$longitud)&& (
                            (strpos($valor,"-")===false) &&
                            (strpos($valor,"/")===false) &&
                             (strpos($valor,".")===false) 
                          )
          ){
          $this->addError('activo',m::t('validaciones', 'Columna  "{columna}" no tiene el formato fecha, observe el valor {valor}'.$msgAdicional,['valor'=>$valor,'columna'=>$nombrecampo]));   
          $validacion=false;    
          }
            
         if($validacion===false){
           break;
         }
      }
      /*if(!$validacion){
          $this->addError('activo',m::t('import.errors', 'Error en el formato de la columna  "{columna}", los tipos no coinciden, revise el archivo de carga',['columna'=>$nombrecampo]));
        // throw new \yii\base\Exception(m::t('import.errors', 'The csv file has not the same type columns "{columna}" than type fields in this load data',['columna'=>$nombrecampo]));
           return false; 
              }*/
      
      //$this->errors=$oldErrors;
      return $validacion;
 }
 
 public function flushLogCarga(){
     (new Query)
    ->createCommand()
    ->delete(ImportLogcargamasiva::tableName(), ['user_id' => h::userId()])
    ->execute();
    
   }
 
    public function logCargaByLine($line,$errores){
         yii::error($errores); 
    // $errores=$this->getErrors();
     foreach($errores as $campo=>$detalle){
         foreach($detalle as $cla=>$mensaje){
             yii::error('uy  recorreindo los errores');
             yii::error($mensaje);
             if(!($this->insertLogCarga($line, $campo, substr($mensaje,0,80), '0')))
               yii::error('uy fallo');       
         }
     }
 }
  

 public function insertLogCarga($line,$campo,$mensaje,$level){
     //$this->flushLogCarga();
    // 
     $attributes=[
         'cargamasiva_id'=>$this->id,
         'nombrecampo'=> $campo,
         'mensaje'=>substr($mensaje,100,180),
         'level'=>$level,
         'fecha'=>date('Y-m-d H:i:s'),
         'user_id'=>h::userId(),
         'numerolinea'=>$line,
     ];
     	$model=new ImportLogcargamasiva();
        //$model->rawDateUser('fecha');
        $model->setAttributes($attributes);
    $grabo= $model->save();
    if(!$grabo){
        \yii::error($model->getErrors());
    }
    return $grabo;
        //if(!$retorno){print_r($model->getErrors());die();}
        //unset($model);
        
        
 }
 
  /*Numero de erores en el log de carga*/
    public function nerrores(){
        if($this->nregistros() >0 ){
          return  ImportLogCargamasiva::find()->
                andFilterWhere(['level'=>'0','user_id'=>h::userId()])->count();
        }else{
            return 0;
        }
    }
   /*Numero de registros en el  log de carga*/
    public function nregistros(){
       // $query=new ImportCargamasivaQuery();
        return  ImportLogcargamasiva::find()->where(['cargamasiva_id' =>$this->id])->count();
    }
 
    /*
   * El active query de los hijos 
   * de los registros hijos de carga
   *  
     */
    public function childQueryLoads($idcarga=null){
        if(is_null($idcarga))
        return static::find()->
       where(['cargamasiva_id' =>$this->id])->orderBy(['cargamasiva_id'=>SORT_DESC]);
    }
    
    public function isComplete(){
        return ($this->current_linea >= $this->total_linea);
    }
   
    
    public function afterSave($insert, $changedAttributes) {
        if(!$insert && $this->activo==self::STATUS_CARGADO )
        $this->deleteFile($this->id); //BORRAR EL ARCHIVO DE CARGA ADJUNTO
        return parent::afterSave($insert, $changedAttributes);
    }
    
    public function beforeSave($insert) {
        if($insert){
            $this->current_linea=0;
             $this->current_linea_test=0;                 
        }
        
        return parent::beforeSave($insert);
    }
    
    
    
   
    /*Retorna si tiene el csv adjunto (El primero) 
    * Hace uso del  behavior FileBehavior , que es una clase extendida(
    * con la funcion nueva getFilesByExtension() que devuelve
    * archivos adjuntos filtrados por la extension  */
     
      public function hasFileCsv(){
    $registros=$this->getFilesByExtension(ImportCargamasiva::EXTENSION_CSV);
      $tiene= (count($registros)>0)?true:false; 
       if(!$tiene){
           $this->addError('activo',m::t('validaciones','This record does not have any file attached '.ImportCargamasiva::EXTENSION_CSV));
           return false;   
       }
       return true;
   }   
   
   /*Si se esta efectando la carga y no ha habido errores
    * en la prueba 
    */
   private function NotHasErrorsInLogAndIsCarga($verdadero){
       //Solo es imposible si hay errores en el log  y ademas es una carga 
      $imposible= ($this->nerrores()>0 and $verdadero)?true:false;
      if($imposible)$this->addError ('activo',m::t('validaciones','Errors have been detected in the log at the time of testing, correct the errors, you can view them in the log'));
     return !$imposible;
      
   }
   
   
   /*
    * Funcion para importar regsitros
    * verdadero: False solo prueba y detecta errores  , true Simulacion
    * 
    */
     public function importar($verdadero=false){
          $timeBegin=microtime(true);   
          set_time_limit(300);
          //ini_set('memory_limit', '-1');
        $interrumpido=false;     
        // $this->flushLogCarga();
        IF(!$verdadero)
        $this->flushLogCarga();//Borra cualquier huella anterior en el log de carga
                     
        $cargamasiva=$this->cargamasiva; 
        $cargamasiva->verifyChilds();//Verificando las filas hijas de metadatos
       $camino=$this->pathFileCsv();
      $linea=$this->firstLineTobegin();
       //$this->verifyFirstRow(); //Verifica la primera fila valida del archivo csv, esto quiere decir que no neesarimente sera la primer linea 
           yii::error('Ahora verficando la validez',__METHOD__);     
        if($this->isReadyToLoad($verdadero) &&
            $this->hasFileCsv() && $this->verifyFirstRow()   &&
            $this->canLoadForStatus($verdadero) &&
             $this->NotHasErrorsInLogAndIsCarga($verdadero)
                ){
            //yii::error('Ya paso ..., inciando el proceso',__METHOD__);  
            // VAR_DUMP($carga->pathFileCsv());die();
                        yii::error('Ya paso ..., Leyendo datos ',__METHOD__);  
                      $datos=$this->dataToImport(); //todo el array de datos para procesar, siempre empezara desde current_linea para adelante 
                      yii::error('El archivo tenia  '.count($datos).' Filas ',__METHOD__);  
                      yii::error('Ya leyo  los datos estanb listos ',__METHOD__);  
                      $filashijas=$cargamasiva->ChildsAsArray();
                   // $linea=($carmasiva->tienecabecera)?$linea:$linea-1;//
                    $oldScenario=$this->getScenario();
                    $this->setScenario(self::SCENARIO_RUNNING);
                    //yii::error('Iniciando Buclede datos leidos del CSV desde la linea  Linea => '.$linea,__METHOD__);  
                     yii::error('Iniciando Buclede datos leidos del CSV ',__METHOD__);   
                foreach ($datos as $fila){ 
                    //yii::error('Esta es la fila a importar ');
                    //yii::error($fila,__METHOD__);
                     //Devuelve el modelo asociado a la importacion
                     //dependiendo si es insercion o actualizacion usa una u otra funcion
                    //yii::error('Esta es la linea => '.$linea,__METHOD__);   
                     //yii::error($fila,__METHOD__); 
                     //  
                   // yii::error($fila,__METHOD__);  
                    $model=($cargamasiva->insercion)?$cargamasiva->modelAsocc():$cargamasiva->findModelAsocc($fila);
                     yii::error('Linea procesada => '.$linea,__METHOD__); 
                     $model->setAttributes($cargamasiva->AttributesForModel($fila,$filashijas));
                        if($verdadero){
                            try{ 
                                 yii::error('Grabando registro  => '.$linea,__METHOD__); 
                    
                              if($model->save()){
                                 yii::error('Grab0  bien bien   => '.$linea,__METHOD__); 
                     
                              }  else{
                                   yii::error('no grabo    => '.$linea,__METHOD__); 
                                 yii::error($model->getErrors()); 
                              }
                            } catch (\yii\db\Exception $ex) {
                                 $model->addError($model->safeAttributes()[0],
                                       $ex->getMessage());
                                 yii::error('caray .. error => '.$linea,__METHOD__); 
                    
                               
                            }
                            
                            
                            
                            }  else{
                            $model->validate(); 
                            } 
                                        if($model->hasErrors()){
                                             yii::error('Tiene errores, aegar log  => '.$linea,__METHOD__); 
                                            // var_dump($model->getErrors()); die(); 
                                            $this->logCargaByLine($linea,$model->getErrors());
                                            }
                                        unset($model);
                                 /*Solo si es carga actualizar la linea actual*/
                               if($verdadero){
                                $this->setAttributes([
                                    'current_linea'=>$linea,
                                    ]);
                                   
                               }else{
                                   $this->setAttributes([
                                    'current_linea_test'=>$linea,
                                    ]);
                               }
                                $this->save();  
                $deltaTime=microtime(true)-$timeBegin;
                            if(timeHelper::excedioDuracion($deltaTime,20) )
                                {
                                     yii::error('Opps se interrumpio  => '.$linea,__METHOD__);      
                                $interrumpido=!$interrumpido;
                                            break; 
                                      }
                            $linea++; 
                         }//fin del for 
                            
                    $this->setScenario(static::SCENARIO_RUNNING);
                    $this->rawDateUser('fechacarga'); //asigan la fecha actual 
                                    $this->setAttributes([
                                        //'current_linea'=>($verdadero)?$linea:0,
                                         'activo'=>static::statusForInterruption($interrumpido, $verdadero),
                                           // 'fechacarga'=>$this->rawToUser('fechacarga'), //asigna la fecha hora actual 
                                                ]);
                                            $this->save(); 
                                $this->setScenario($oldScenario);
              
        }else{//Si no esta listo para procesar entonces 
            //var_dump($verdadero, $this->canLoadForStatus($verdadero),"no pasa nad a",$this->getErrors());
            /* var_dump($this->isReadyToLoad($verdadero),
                        $this->hasFileCsv(),
                        $this->verifyFirstRow(),
                        $this->canLoadForStatus($verdadero),
                        //$this->getErrors(),
                        $this->NotHasErrorsInLogAndIsCarga($verdadero),
                        $this->getErrors()
                        ) ;
                    die();*/
            $interrumpido=false;
           $this->addError('activo',m::t('validaciones', 'General validation has not passed'));
        
           return -1;
           
        }     
     ///$this->addError('activo',$camino);
   return $linea;
    }
    
    /*
     * FUNCION QUE COLOCA EL STATUS SEGUN EL CUADRO DE VERDAD SIGUIENTE
     * 
     *  ----------------------------------------------------------
     * |         \   INTERRUMPIDO  |                |
     * |          \                |                |
     *   VERDADERO \               |     SI         |    NO
     * |            \              |                |
     * |-----------------------------------------------------------
     * |                           |                |
     * |          NO               |ESTADO_ABIERTO  | ESTADO_PROBADO
     * |                           |  LINEA INICIO  |  LINEA FINAL
     * |---------------------------|----------------|---------------
     * |                           |                |
     * |            SI             | ESTADO PROBADO | ESTADO CARGADO
     * |                           |  INCOMPLETO    |    LINEA FINAL
     * |                           |  LINEA DONDEQUEDO | 
     *  -------------------------------------------------------------
     */ 
    
   PRIVATE static FUNCTION statusForInterruption($interrumpido,$verdadero){
      if($interrumpido && !$verdadero)//primer cuadrito
       return self::STATUS_ABIERTO;
      if(!$interrumpido && !$verdadero)//segundo cuadrito
       return self::STATUS_PROBADO;
       if($interrumpido && $verdadero)//tercer cuadrito
       return self::STATUS_CARGADO_INCOMPLETO;
        if(!$interrumpido && $verdadero)//cuartor cuadrito
       return self::STATUS_CARGADO;      
   }
           
   /*
     *FUNCION QUE DETERMINA EL BOLLEANO SEGUN LA TABLA DE VERDAD
    * para ejecutar una carga o una prueba 
    * 
    * ---------------------------------------------------------------------------
    *                       ABIERTO     PROBADO     CARGADO_INCOMPLETO      CARGADO
    * ---------------------------------------------------------------------------
    *       PRUEBA           OK           IMPOSIBLE      IMPOSIBLE         IMPOSIBLE
    * --------------------------------------------------------------------------
    *       CARGA            IMPOSIBLE       OK               OK     IMPOSIBLE
    * ----------------------------------------------------------------------------
    * @verdadero:  TRUE se trata de una carga, false : se trata de una prueba 
    * 
    * 
     */
   private function canLoadForStatus($verdadero){
       $estado=$this->activo;  
       /* if(!$verdadero && ($estado==self::STATUS_PROBADO)){
          $this->addError('activo',m::t('import.errors','Este registro ya está probado, revise el log de prueba'));
          return false;  
        }*/
         if(!$verdadero && ($estado==self::STATUS_CARGADO_INCOMPLETO)){
           $this->addError('activo',m::t('validaciones','This record is incompletely loaded'));
          return false;  
         }
          if(!$verdadero && ($estado==self::STATUS_CARGADO)){
              $this->addError('activo',m::t('validaciones','This record is already uploaded'));
            return false;
          }
          if($verdadero && ($estado==self::STATUS_ABIERTO)){
               $this->addError('activo',m::t('validaciones','This record cannot be loaded, has not been tested yet, and should be error free'));
           return false;
          }
         if($verdadero && ($estado==self::STATUS_CARGADO)){
            $this->addError('activo',m::t('validaciones','This record is already uploaded'));
            return false;
         }
         return true;
    }    
   
   
     private function isReadyToLoad($verdadero){ 
         
         $estado=$this->activo;
         //var_dump($estado,$this->activo);die();
         $isReady=(
            (!$verdadero && ($estado==self::STATUS_ABIERTO)) or 
              !$verdadero && ($estado==self::STATUS_PROBADO) or   
            ($verdadero && ($estado==self::STATUS_PROBADO)) or 
            ($verdadero && ($estado==self::STATUS_CARGADO_INCOMPLETO))             
           )?true:false;
         if(!$isReady)$this->addError ('activo',m::t('validaciones','The registration status does not allow the operation to be carried out'));
         return $isReady;
    } 

public static function lastRecordCreated(){
    return static::find()->
            where(['user_id'=>h::userId()])->
            orderBy(['id' => SORT_DESC])->one();
}

/*
 * Saca toda la infor del archivo adjunto
 * Solo del primer archivo adjunto  $this->files[0] el resto 
 * lo ignora   $this->files[0]
 */
public function infoFileAttached(){
    $info=[];
    if($this->hasAttachments()){
        $info['extension']=$this->files[0]->type."-".$this->files[0]->mime;
        $info['name']=$this->files[0]->type."-".$this->files[0]->mime;
    }else{
        return [];
    }
}
    
}

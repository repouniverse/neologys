<?php

namespace frontend\modules\import\models;
use frontend\modules\import\ModuleImport as m;
use frontend\modules\import\components\CSVReader as MyCSVReader;
use common\helpers\h;
use common\helpers\FileHelper;
use yii\helpers\ArrayHelper;
use common\behaviors\FileBehavior;
use frontend\modules\import\models\ImportLogcargamasiva;
use frontend\modules\import\models\ImportCargamasivaUser;
use frontend\modules\import\behaviors\csvBehavior;
use frontend\modules\import\ModuleImport;
use Yii;
use yii\web\NotFoundHttpException;
use common\models\base\modelBase;
/**
 * This is the model class for table "{{%import_cargamasiva}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $insercion
 * @property string $escenario
 * @property string $lastimport
 * @property string $descripcion
 * @property string $format
 * @property string $modelo
 *
 * @property ImportCargamasivadet[] $importCargamasivadets
 */
class ImportCargamasiva extends modelBase
{
  
     const EXTENSION_CSV='csv';
    public $booleanFields=['insercion','tienecabecera'];
    public $hardFields=['modelo','escenario'];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%import_cargamasiva}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['insercion', 'escenario', 'descripcion', 'format', 'modelo'], 'required'],
            [['user_id'], 'integer'],
            [['tienecabecera'], 'safe'],
            [['escenario', 'descripcion'], 'string', 'max' => 40],
            [['lastimport'], 'string', 'max' => 18],
            [['format'], 'string', 'max' => 3],
            [['modelo'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => m::t('labels', 'ID'),
            'user_id' => m::t('labels', 'User'),
            'insercion' => m::t('labels', 'Insertion'),
            'escenario' => m::t('labels', 'Stage'),
            'lastimport' => m::t('labels', 'Last Load'),
            'descripcion' => m::t('labels', 'Description'),
            'format' => m::t('labels', 'Format'),
            'modelo' => m::t('labels', 'Table'),
        ];
    }
    
       public function behaviors()
        {
	return [
		
		'fileBehavior' => [
			'class' => FileBehavior::className()
		],
            /*'csvBehavior' => [
			'class' => csvBehavior::className()
		]*/
		
	];
            }
    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImportCargamasivadet()
    {
        return $this->hasMany(ImportCargamasivadet::className(), ['cargamasiva_id' => 'id']);
    }
    
   
    public function getImportLogCargamasiva()
    {
        return $this->hasMany(ImportLogCargamasiva::className(), ['cargamasiva_id' => 'id']);
    }
    
    
    public function getImportCargamasivaUser()
    {
        return $this->hasMany(ImportCargamasivaUser::className(), ['cargamasiva_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ImportCargamasivaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ImportCargamasivaQuery(get_called_class());
    }
    
   
    
   
    
    /*Numero de exitos en el log de carga*/
    public function nexitos(){
        if(count($this->nregistros()) >0 ){
          return   ImportLogCargamasiva::find()->
                where(['level'=>'1','user_id'=>h::userId()])->count();
        }else{
            return 0;
        }
    }
    /*
     * Regresa una instancia del modelo asociado
     * en la propiedad 'modelo'
     */
    public function modelAsocc($escenario=null){     
           $clase=New $this->modelo;
       if(!is_null($escenario)){
           $clase->setScenario($escenario);
       }else{
           $clase->setScenario($this->escenario);
       }
        
      return $clase;
    }
    
    
    private function insertChilds(){
       //VAR_DUMP($this->ordenCampos());DIE();
            $modeloatratar=$this->modelAsocc();
             $columnas=$modeloatratar->getTableSchema()->columns;
                $i=1;
              // VAR_DUMP($this->ordenCampos());DIE();
               // print_r($columnas);die();
              foreach($columnas as $nameField=>$oBCol){ 
                	if(
                         ( $modeloatratar->isAttributeSafe($nameField) &&
                          !$this->existsChildField($nameField) && 
                          !($oBCol->dbType =='text') ) 
                    /* o ES update y el campo es clave*/ or ( !$this->insercion && in_array($nameField,$modeloatratar->primaryKey(true)) )
                     ){
                          //yii::error($nameField,__METHOD__);   
                        yii::error($oBCol->dbType,__METHOD__);
                        //yii::error('CALVES ORANEAS');
                        //yii::error($modeloatratar->fieldsLink(false));
                         
                        if(ImportCargamasivadet::firstOrCreateStatic(
                                        [
                                           'cargamasiva_id'=>$this->id,
                                             'nombrecampo'=>$nameField,
                                            'aliascampo'=>$modeloatratar->getAttributeLabel($nameField),
                                            'sizecampo'=>$oBCol->size,
                                            'activa'=>true,
                                            'requerida'=>$modeloatratar->isAttributeRequired($nameField),
                                            'tipo'=>$oBCol->dbType,
                                            'orden'=>$this->ordenCampos()[$nameField]+1,
                                            'esclave'=>in_array($nameField,$modeloatratar->primaryKey(true))?true:false,
                                            'esforeign'=>in_array($nameField,array_keys($modeloatratar->fieldsLink(false))),
                                            
                                        ]))
                                $i++;
                                 }
              } 
    }
    
    public function afterSave($insert,$changedAttributes) {
        if($insert){
           
           $this->insertChilds();
                                       
        }
       return parent::afterSave($insert,$changedAttributes);
    }
  
    
    public function existsChildField($nombrecampo){
        
        return (count($this->childQuery()->andFilterWhere(
                 ['nombrecampo'=>$nombrecampo]
                  )->asArray()->all())>0)?true:false; 
        
        
    }
    /*CARGA LOS ESCENARIOS DEL ODELO ASOCIOADO*/
    public function loadScenariosFromModel(){
       return array_keys($this->modelAsocc()->scenarios());
       
    }
    
    /*
     * El active que3ry de los hijos 
     */
    public function childQuery(){
        return ImportCargamasivadet::find()->
       where(['cargamasiva_id' =>$this->id]);
    }
    
    public function countChilds(){
       return $this->childQuery()->/*where(['activa'=>'1'])->*/count();
    }
    
   public function verifyChilds(){
       $query=$this->childQuery();
       $sinorden=$query->
       andFilterWhere(['orden'=>0])->asArray()->all();
      if(count($sinorden)>0)       
        throw new \yii\base\Exception(m::t('validaciones', 'The import records has a field {field} with  \'order\' = 0 ',['field'=>$sinorden[0]['nombrecampo']]));
   
      $sinlongitud=$query->
       andFilterWhere(['sizecampo'=>0])->asArray()->all();
      if(count($sinlongitud)>0)       
        throw new \yii\base\Exception(m::t('validaciones', 'The import records has a field {field} with  \'size\' = 0 ',['field'=>$sinlongitud[0]['nombrecampo']]));
   
     /* $sinprimercampo=$query->
       andFilterWhere(['esclave'=>'1'])->asArray()->all();
      if(count($sinprimercampo)==0)       
        throw new \yii\base\Exception(m::t('m_import', 'The import records has not a field key'));
   */
   }
   
   public function hasAttach(){
       return (count($this->files)>0)?true:false;
   }
   
  
   
  public function Childs(){
     
     return $this->childQuery()->orderBy(['orden'=>SORT_ASC])->all();
  }
  public function ChildsAsArray(){
     return   $this->childQuery()->orderBy(['orden'=>SORT_ASC])->asArray()->all();
  }
  
  
 /*
  * prepara los atributos para almacenarlos en el modelo
  * usa una fila de csv  y los nombres de los campos
  * en la carga
  * @row: Una fila del archivo csv (es una array de valores devuelto
  *  por la funcion fgetcsv())
   * @filashijas : array de registros hijos del objeto de carga
  */
 public function AttributesForModel($row,$filashijas){ 
      //$filashijas=$this->childQuery()->orderBy(['orden'=>SORT_ASC])->asArray()->all();
     //$modelo=$cargamasiva->modelAsocc();
     $attributes=[];
      foreach($row as $orden=>$valor){          
               $attributes[$filashijas[$orden]['nombrecampo']]= utf8_encode($valor);
           }
     return $attributes;  
 }
 
 /*
  * Asigna  valores a los campos clave 
  * leyendolos de  un fila de datos $row, util para hallar 
  * modelos a partir de los datos de $row 
  *  @row: Una fila del archivo csv (es una array de valores devuelto
  *  por la funcion fgetcsv())
   * @fieldsPk : array asociativo de nombre de campos clave y su orden  ['campoclave1'=>1 ,'campoclavex'=>2]
  */
  
 
 public function AttributesPkForFindModel($row,$fieldsPk){
     $attributes=[];
      foreach($fieldsPk as $nameField=>$order){
               $attributes[$nameField]=$row[$order-1];
           }
     return $attributes;  
 }
 
 public function isTypeChar($tipo){
     return (substr(strtoupper($tipo),0,4)=='CHAR');
 }
 public function isTypeVarChar($tipo){
     return (substr(strtoupper($tipo),0,7)=='VARCHAR');
 }
 public function isNumeric($tipo){
     return ((substr(strtoupper($tipo),0,3)=='INT')or
                  (substr(strtoupper($tipo),0,4)=='DOUB')OR
                  (substr(strtoupper($tipo),0,4)=='DECI')
                  ) ;
 }
public function isDateorTime($tipo,$nombrecampo,$longitud){
     return (((substr(strtoupper($tipo),0,4)=='CHAR')or
                  (substr(strtoupper($tipo),0,5)=='VARCHAR')
                   )&& (in_array($longitud,[10,19])) && 
                    (in_array($nombrecampo,$this->modelAsocc()->dateTimeFields)));
 }
 
 
 /*
  * Esta funcion devuelve los campos clave del 
  * modelo asociado, siempre que estos se registren como tal
  * 'esclave'='1'
  */
 
 public function camposClave(){   
     $filas=$this->childQuery()->
                 select(['nombrecampo','orden'])->
                 andWhere(['esclave'=>'1'])->
                 asArray()->all();
     return array_combine(ArrayHelper::getColumn($filas,'nombrecampo'),
                   ArrayHelper::getColumn($filas,'orden'));
 }
 
 
   
   

   
 /*
  * Esta funcion devuelve el registro hijo de 
  * solo registro activo, estre registro es el que 
  * gestionara la carga    */
 public function activeRecordLoad(){
    $registro= ImportCargamasivaUser::childQueryLoads()->where(['activo'=>'1'])->andFilterWhere(['not',['activo'=>ImportCargamasivaUser::STATUS_CARGADO]])->one();
    if(is_null($registro)){
        throw new \yii\base\Exception(m::t('validaciones', 'Verify that there is a pending upload record, all are finished or none are open'));
    }else{
        return $registro;
    }
 } 
 
public function ordenCampos(){
    $modelo=$this->modelAsocc();
    $camposSafe=$modelo->getSafeFields();
    //ECHO get_class($modelo);die();
     $intersecion= array_intersect($camposSafe,$modelo->primaryKey());
  if(!$this->insercion){
     if(count($intersecion)==0){
         //echo 'ttytyt';die();
         $arraycampos=array_merge($modelo->primaryKey(),$camposSafe);
         //return array_keys($arraycampos); 
       return array_combine(array_values($arraycampos),array_keys($arraycampos));
   }else{
       //echo 'es iaaa';die();
      return array_flip($camposSafe); 
   }
      
  }else{
    //echo 'es insercion';die();
   /*print_r($modelo->safeFields);
    print_r($modelo->primaryKey());die();*/
   if(count($intersecion)==0){
       return array_flip($camposSafe);
   }elseif(count($intersecion)==count($modelo->primaryKey())){
     $base=array_diff($camposSafe,$modelo->primaryKey());
     return array_flip(array_values(array_merge($modelo->primaryKey(),$base)));
   }else{
      $base=array_diff($camposSafe, array_intersect($modelo->primaryKey(),$camposSafe)); 
      return array_flip(array_values(array_merge(array_intersect($modelo->primaryKey(),$camposSafe),$base)));
   }  
  }
  
}
 
  public function findModelAsocc($fila,$scenario=null){
      //$model=$this->modelAsocc();
       ///yii::error('findomodelAssoc Encontrando model');
      $clase=$this->modelo;
      //yii::error('findomodelAssoc Encontrando');
      //yii::error($this->camposClave());
      //dfdggd; fdsff;
     // yii::error($this->AttributesPkForFindModel($fila,$this->camposClave()));
      $registro=$clase::find()->where(
              $this->AttributesPkForFindModel($fila,$this->camposClave())
              )->one();
      if(is_null($registro)) 
      throw new NotFoundHttpException(m::t('validaciones', 'The record does not exist'));
      return $registro;
  }
 public function beforeSave($insert) {
        if($insert){
            $this->user_id=h::userId();
        }
       return parent::beforeSave($insert);
    }
    /*NO USAR, YA SE REEMPLAZO ESTA FUNCION EN UN BEHAVIOR*/
  public function generateExampleCsv($model,$campo=null){
      yii::error('ingresando');
       $childFields=$this->childsField($model,$campo);
      //var_dump($modelo);die();
      $filas=$this->dataArrayToCsvExample($model,$campo);  
      $prefijo=(is_null($campo))?str_replace(' ','_',$this->descripcion).'_':
              $campo.'_';
      //$prefijo='';
       $pathComplete= ModuleImport::getPathCsv().DIRECTORY_SEPARATOR.$prefijo.FileHelper::randomNameFile('.csv');
       //ECHO FileHelper::randomNameFile('.csv');DIE();
       if (!$file_handle = fopen($pathComplete, "w")) {  
        echo "El archivo no se puede crear";
        exit;  
               }
               $filac=array_keys($childFields);
            $filac=array_map("utf8_decode", $filac);
        if(fputcsv(                
        $file_handle,$filac,
        h::gsetting('import','delimiterCsv')
                )===false){
           echo "Ocurrió un error al escribir";fclose($file_handle);DIE(); 
        }else{
              }
     foreach($filas as $fila){
         fputcsv(
                $file_handle, array_values($fila),
               h::gsetting('import','delimiterCsv') 
                ); 
     }
     rewind($file_handle);
     fclose($file_handle);
       return   $pathComplete;
  }  
   
      
  
  /*
   * DEVUELVE UN ARRAY CON LOS CAMPOS 
   * DEl modelo asoiciado 
   * peje: SI el modelo asociado es CLipro 
   * retorna 
   * ['Cod. Proveedor'=>'codpro','R.U.C.'=>'rucpro','Descripcion'=>'despro',...]
   * Segun el escenario
   */
  
  public function childsField($model,$campo=null ){
      
     if(('\\'.$model::className()==$this->modelo)){
         $childs=$this->ChildsAsArray();
          return array_combine(array_column($childs,'aliascampo'),
              array_column($childs,'nombrecampo'));
     }else{
         //var_dump(in_array($campo,array_keys($model->attributes)),$campo,array_keys($model->attributes));
         yii::error('El campo '.$campo);
         if(!(in_array($campo,array_keys($model->attributes))))
         throw new \yii\base\Exception(m::t('validaciones', 'No existe el campo \'{campo}\' para la tabla \'{tabla}\'',['campo'=>$campo,'tabla'=>$model->tableName()]));
            $arr=[];
         $safeFields=$model->getSafeFields();
         if(!in_array($campo,$safeFields)){
            $safeFields[]=$campo; 
         }
         /*Ordenando los campos para que aperaca primero el camppo foraneo*/
        $index=array_search($campo,$safeFields);
        unset($safeFields[$index]);
        array_unshift($safeFields, $campo);
         
         
         foreach($safeFields as $field){
             $label=$model->getAttributeLabel($field);
             if($label==''){
                 $label=$field;
             }
            $arr[$label]= $field;
         }
        return $arr;
     }
      
  }
  
  public function  dataArrayToCsvExample($model,$campo=null){
      //var_dump($this->childsField($model));die();
       return  $model->find()->
       select(array_values($this->childsField($model,$campo)))->
      limit(200)->asArray()->all();    
    }
  
 public function hasLoads(){
     return $this->getImportCargamasivaUser()->exists();
 }
}

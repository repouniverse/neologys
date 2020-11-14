<?php
/*******************************************
 * TRAIT PARA ESTABLECER FUNCIONES COMUNES 
 * A LAS IDENTIDADES 
 * COMO COMO SINCRONIZAR 
 * 
 ******************************************/
namespace common\traits;
use yii;
use  yii\web\ServerErrorHttpException;
use common\models\masters\Personas;
use common\helpers\FileHelper;
use common\models\masters\GrupoPersonas;
use common\helpers\h;
trait identidadTrait
{
    private $camposComunes=
    [
        'ap','am','nombres','tipodoc','numerodoc'
    ];
    
    private $_persona=null;
        
    private function queryPerson(){
        return Personas::find()->andWhere([
            'ap'=>$this->ap,
            'am'=>$this->am,
            'nombres'=>$this->nombres,
        ]);
    }
    
    
    
    private function queryDocument(){
        return Personas::find()->andWhere([
            //'ap'=>$this->ap,
            'tipodoc'=>$this->tipodoc,
            'numerodoc'=>$this->numerodoc,
        ]);
    }
    private function existsNamesInPerson(){
        //echo $this->queryPerson()->exists();die();
        return $this->queryPerson()->exists();
    }
    
    private function existsDocInPerson(){
        
        return $this->queryDocument()->exists();
    }
   
    
    public function hasHomonimo(){
        /*Por ahora asi de sencillo*/
        return $this->existsNamesInPerson();
    }
    
    
    public function createPersonFromThis(){
      yii::error('crendo personas ');
      $existe=$this->existsDocInPerson();
       //$existe=existsDocInPerson();
          if($existe){
              YII::ERROR('EXISTE UNA PERSONA CON ESOS DOCUMENTOS');
              $persona=$this->queryDocument()->one();
             $model= $this::className();
             $model::UpdateAll(['persona_id'=>$persona->id],
                    ['id'=>$this->id]);
          }
      
        if(!$this->isNewRecord && !$existe){
            //$this->refresh();
         
          
          
          
          yii::error('paso ');
          Personas::firstOrCreateStatic(
                  $this->prepareAtributes(),
                  Personas::SCE_CREACION_BASICA,
                 [
            //'ap'=>$this->ap,
            'tipodoc'=>$this->tipodoc,
            'numerodoc'=>$this->numerodoc,
                        ]);
          /*$model=New Personas();
            $model->setScenario(Personas::SCE_CREACION_BASICA);
            $model->setAttributes($this->prepareAtributes());
             //var_dump($this->prepareAtributes());
           // var_dump($model->attributes);die();
            if(!$model->save()){ print_r($model->getErrors()); DIE();}
            return $model->save();*/
        }elseif(!$this->isNewRecord && $existe){
            
        }
        return false;
    }
    
   private function prepareAtributes(){
       $atri=[];
       foreach($this->camposComunes as $index=>$campo){
           $atri[$campo]=$this->{$campo};
       }
        
       /*pero falta agrar el id de esta identidad*/
       $atri['identidad_id']=$this->id;
        $atri['codgrupo']=$this->obtenerGrupo();
       return $atri;
   } 
      
    public function getPersona() {
        if(is_null($this->_persona))
           return $this->hasOne(Personas::className(), ['id' => 'persona_id']);
        return $this->_persona;
        /* echo  $this->hasOne(Talleresdet::className(), ['id' => 'talleresdet_id'])->createCommand()
          ->getRawSql();die(); */
        //echo Personas::find()->andWhere(['id' => 'persona_id','codgrupo'=>$this->obtenerGrupo()])->createCommand()->rawSql;die();
        //return Personas::find()->andWhere(['id' => $this->persona_id,'codgrupo'=>$this->obtenerGrupo()])->one();
    }
    
    
   private function obtenerGrupo(){
       $clase='\\'.self::className();
       //print_r(['modelo'=>self::className()]);die();
       $m=GrupoPersonas::find()->andWhere(['modelo'=>$clase])->one();
       //echo GrupoPersonas::find()->andWhere(['modelo'=>$clase])->createCommand()->rawSql;
       //die();
       if(is_null($m))
        throw new ServerErrorHttpException(Yii::t('base.errors', 'Don\'t exists code group to this Class in table "grupoPersonas.modelo"' ));
    		    
       return $m->codgrupo;
        }
   
    
     public function image($codigo){
         if(h::gsetting('general','showImgExternal') or h::user()->profile->recexternos){
          $hasExternal=self::externalUrlImage($codigo);
         if($hasExternal)
         return $hasExternal;
        return  FileHelper::getUrlImageUserGuest();  
     } else{
        return  FileHelper::getUrlImageUserGuest();   
     }
     }
  
    private static function  externalUrlImage($codigo){
      $extension=h::settings()->get('general','extensionimagesalu');
        if(!(substr($extension,0,1)=='.'))
         $extension='.'.$extension;
        
      $urlExt= FileHelper::normalizePath(
             h::settings()->get('general','urlimagesalu')
           // .h::settings()->get('sta','prefiximagesalu') 
            .$codigo
            .$extension,'/');   
     //VAR_DUMP($urlExt,FileHelper::checkUrlFound($urlExt));DIE();
      if(FileHelper::checkUrlFound($urlExt)){
          return $urlExt;
      }else{
        return false; 
      }
   }     
        
 /*
  * FUCNION PARA VALIDAR LOS DUPLICADOS 
  * esta funcion revisa si hay un numero de documento
  * y btipo en la tabla PERSONAS. Si la hay 
  * verifica que los AP, AM, Y NOBRES SEAN IDENTICOS
  * de otro modo no lo deja pasar
  * 
  */
   
   public function validateDuplicado($attribute, $params) {
       //yii::error('validado duplicado');
      // yii::error($this->existsNamesInPerson());
        //yii::error($this->existsDocInPerson());
        //var_dump(!$this->existsNamesInPerson() && $this->existsDocInPerson());die();
       if($this->isNewRecord){
       $message='There is a person with the same identity '
            . 'number but the names do not match,Verify '
            . 'that the full names are the same';
    
    if(!$this->existsNamesInPerson() && $this->existsDocInPerson())
        $this->addError('numerodoc',yii::t('base_errors',$message
            ));
       }
    
   } 
   
   public function sincronizeFields(){
       $persona=$this->persona;
    if(!is_null($persona)){
        foreach($this->camposComunes as $key=>$nameField){
          $persona->{$nameField}=$this->{$nameField};
      } 
      return $persona->save();
    }else{
        return false;
    }
      
   }
   
}

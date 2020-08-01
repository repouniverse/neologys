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
use common\models\masters\GrupoPersonas;
trait identidadTrait
{
   private $camposComunes=[
       'ap','am','nombres','tipodoc','numerodoc'
   ];
    
    private function queryPerson(){
        return Personas::find()->andWhere([
            'ap'=>$this->ap,
            'am'=>$this->am,
            'nombres'=>$this->nombres,
        ]);
    }
    private function existsNamesInPerson(){
        
        return $this->queryPerson()->exists();
    }
   
    
    public function hasHomonimo(){
        /*Por ahora asi de sencillo*/
        return $this->existsNamesInPerson();
    }
    
    
    public function createPersonFromThis(){
      
        if(!$this->isNewRecord && !$this->hasHomonimo()){
            //$this->refresh();
          
            $model=New Personas();
            $model->setScenario(Personas::SCE_CREACION_BASICA);
            $model->setAttributes($this->prepareAtributes());
             //var_dump($this->prepareAtributes());
           // var_dump($model->attributes);die();
            if(!$model->save()){ print_r($model->getErrors()); DIE();}
            return $model->save();
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
        /* echo  $this->hasOne(Talleresdet::className(), ['id' => 'talleresdet_id'])->createCommand()
          ->getRawSql();die(); */
        return $this->hasOne(Personas::className(), ['id' => 'persona_id']);
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
   
    
  
        
        
   
   
}

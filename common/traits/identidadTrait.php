<?php
/*******************************************
 * TRAIT PARA ESTABLECER FUNCIONES COMUNES 
 * A LAS IDENTIDADES 
 * COMO COMO SINCRONIZAR 
 * 
 ******************************************/
namespace common\traits;
use yii;
use common\models\masters\Personas;
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
        if(!$this->hasHomonimo()){
            $model=New Personas();
            $model->setScenario(Personas::SCE_CREACION_BASICA);
            $model->setAttributes($this->prepareAtributes());
            return $model->save();
        }return false;
    }

    
   private function prepareAtributes(){
       $atri=[];
       foreach($this->camposComunes as $index=>$campo){
           $atri[$this->{$campo}]=$campo;
       }
       return $atri;
   } 
   
    public function getPersona() {
        /* echo  $this->hasOne(Talleresdet::className(), ['id' => 'talleresdet_id'])->createCommand()
          ->getRawSql();die(); */
        return $this->hasOne(Personas::className(), ['id' => 'persona_id']);
    }
    
    

   
   
}

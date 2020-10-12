<?php
/**
 * Creado por  Jramirez

 * Date: 20.05.2020
 * Time: 12:24
 */

namespace common\behaviors;
use yii;
use yii\base\Behavior;
use yii\helpers\Json;
use common\models\AccesDocu;
use common\helpers\h;
//use yii\db\ActiveRecord;
use yii\web\ServerErrorHttpException;
use common\models\base\modelBase as Base;
use common\models\audit\AccessDocuLog;


class AccessDownloadBehavior extends Behavior
{
 const FIELD_NAME='codocu';  
 
 const ACCESS_VIEW='10';
  const ACCESS_MAIL='20';
  const ACCESS_DOWNLOAD='30';
  const ACCESS_DOWNLOAD_ZIP='40';
  
   
    
  private function ValidateBehavior(){
      $owner=$this->owner;
      if (!$this->owner->hasProperty(self::FIELD_NAME)){
          throw new ServerErrorHttpException(Yii::t('models.errors', 'Este modelo no tiene la propiedad  '.self::FIELD_NAME));
      }
     /* if ($owner instanceof \common\models\base\modelBase){
          throw new ServerErrorHttpException(Yii::t('models.errors', 'Este modelo no es de la instancia de  '.get_class(modelBase)));
      }
      */
  }
  
private function queryBase(){
    $this->ValidateBehavior();
   $owner=$this->owner;
   return   AccesDocu::find()->where([
         'modelo'=>$owner->getShortNameClass(),
         'codocu'=>$owner->{self::FIELD_NAME},
         'profile'=>h::user()->getProfile()->tipo,    
             ]);  
}  
 public function canDownLoad(){
     $query=$this->queryBase()->andWhere(['download'=>'1']);
     return $query->exists();     
 }
 
 public function canPreview(){
     $query=$this->queryBase()->andWhere(['preview'=>'1']);
     return $query->exists();     
 }
 
 public function canUpload(){
     $query=$this->queryBase()->andWhere(['upload'=>'1']);
     return $query->exists();     
 }

public function canDelete(){
     $query=$this->queryBase()->andWhere(['delete'=>'1']);
     return $query->exists();     
 } 
 
 
 public function logAudit($canal){
    $owner=$this->owner;
   $model=new  AccessDocuLog();
   $attributes=['canal'=>$canal,
       'user_id'=>h::userId(),
       'id_model'=>$owner->id,
       'fecha_hora'=>date(\common\helpers\timeHelper::formatMysqlDateTime()),
       'model_class'=>$owner->getShortNameClass(),
       'codocu'=>$owner->{self::FIELD_NAME},
       ];
   $model->setAttributes($attributes);
   return $model->save();
   
 }
 
 
 public static function iconCanal($canal){
    if(self::ACCESS_MAIL==$canal){
        return 'fa fa-envelope';
    }elseif(self::ACCESS_DOWNLOAD==$canal){
        return 'fa fa-download';
    }elseif(self::ACCESS_DOWNLOAD_ZIP==$canal){
         return 'fa fa-file-archive';
    }elseif(self::ACCESS_VIEW==$canal){
         return 'fa fa-eye';
    }else{
        return 'fa fa-file';
    }
 }
  
}
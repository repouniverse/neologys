<?php
namespace common\traits;
use nemmo\attachments\models\File;
use yii;
trait attachmentTrait
{

    
   public function hasAttach($id,$modelName){      
      return File::find()->select(['itemId'])->
              andWhere(['itemId'=>$id,'model'=>$modelName])->limit(1)->exists();
   } 
   /*
    * USARLO PARA FILTRAR EN LOS MODELSSEARCHS 
    * PARA VER QUIEN TIENE ADJUNTOS Y QUIEN NO 
    */ 
  public function idsInAttachments($modelName){
    return File::find()->select(['itemId'])->
              andWhere(['model'=>$modelName])->column();
    
  }
    
   
}

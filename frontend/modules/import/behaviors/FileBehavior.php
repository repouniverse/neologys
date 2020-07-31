<?php
namespace frontend\modules\import\behaviors;
use common\behaviors\FileBehavior as Fileb;
use nemmo\attachments\models\File;
use common\helpers\FileHelper;
USE yii\db\ActiveRecord;

/*
 * Esta clase se extiende de la clase general
 * common

 * 
 */

class FileBehavior extends  Fileb
{
  
    /*Aregando un evento pàra 
     * registrar las subidas de  los archivos 
     * 
     */
    public function events()
    {
       $originalEvents=parent::events(); 
        $originalEvents[ActiveRecord::EVENT_AFTER_INSERT]='infoFromUpload';
        $originalEvents[ActiveRecord::EVENT_AFTER_UPDATE]='infoFromUpload';
       
       \yii::error( $originalEvents);
       return parent::events();
       
    }
    
    public function  infoFromUpload($event){
        
        yii::error('esta funcionando el evento');
    }


    
   
    
    
   
}

<?php
namespace frontend\modules\import\behaviors;
use yii\base\Behavior;
use frontend\modules\import\ModuleImport;
use common\helpers\h;
class csvBehavior extends Behavior
{
    
    
public function generateExampleCsv($nameFileCsv,$childFields=null){

     if(is_null($childFields)){
       $childFields=$this->fieldsChildsBehavior();  
     }
      
      $filas=$this->owner->find()->
       select(array_values($childFields))->
      limit(10)->asArray()->all(); 
     
      //yii::error('las filas y HAN PASADO  '.(time()-$tiempoactual).'   segundos');  
      $pathComplete= ModuleImport::getPathCsv().DIRECTORY_SEPARATOR.$nameFileCsv;
       if (!$file_handle = fopen($pathComplete, "w")) {  
        echo "El archivo no se puede crear";
        exit;  
               }
       
       // yii::error('creao el archivo   '.(time()-$tiempoactual).'   segundos');  
      
      /*
       * Insertaoms la cabecera con los alias de los 
       * campos
       */
          //yii::error($file_handle);
        //yii::error('Colcando la cabecera  y han pasdo   '.(time()-$tiempoactual).'   segundos');  
        //print_r(array_keys($childFields));
        if(fputcsv(                
        $file_handle, array_keys($childFields),
        h::gsetting('import','delimiterCsv')
                )===false){
          //yii::error('Escribiola cebcera   y han pasdo   '.(time()-$tiempoactual).'   segundos');  
          
          echo "HUoi un error al escribir";fclose($file_handle);DIE(); 
        }else{
            //echo "Escribio la cabcecera carat";fclose($file_handle);DIE();
          // yii::error('hubo un error al escribir la cabecera'); 
        }
               
                          
         /*
          * Ahora insertamos los datos
          */   
       //yii::error('Escribeindo los datos    y han pasdo   '.(time()-$tiempoactual).'   segundos');  
          
     foreach($filas as $fila){
         // yii::error('El bucle     la fila[0]     '.$fila[0].'  ha pasado  '.(time()-$tiempoactual).'   segundos');  
      
        fputcsv(
                $file_handle, array_values($fila),
               h::gsetting('import','delimiterCsv') 
                ); 
     }
     
     rewind($file_handle);
     fclose($file_handle);
      //yii::error('cerrando el archivo ha pasado  '.(time()-$tiempoactual).'   segundos');  
      //echo "ya cerro";die();
     return   $pathComplete; 
     
}

private function fieldsChildsBehavior(){
   return $this->owner->getSafeFields();
}

     }

?>

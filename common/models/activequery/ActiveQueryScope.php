<?php
namespace common\models\activequery;
use frontend\modules\sta\models\UserFacultades;
use common\helpers\h;
/* 
 * Esta clase es la que efectua los filtros por facultad segun 
 * el perfil del ususario; es decir 
 * cualquier persona no puede visulaizar registros de otras facultades
 * por convencion el campo de criterio es el campo
 * "codfac" 
 */
class ActiveQueryScope extends \yii\db\ActiveQuery 
{
    
   const LEVEL_DPTO=2;
   CONST LEVEL_FACULTAD=1;
    
 /* public function init()
    {
      //var_dump(UserFacultades::filterFacultades());die();
       //$this->andWhere([ 'in', 'codfac',['FIM','FIP'] ]);
      $this->alias('t')->andWhere(['in',
              't.codfac', UserFacultades::filterFacultades()
               ])->andWhere(['t.clase'=> staModule::CLASE_RIESGO]);
        parent::init();
    }
    // HOLA MODIFICANDO
*/
   /*
    * FUNCION QUE APLICA LOS SCOPES AL MODELO 
    * QUE USA ESTA CLASE
    */
    public function findFilter($level=self::LEVEL_DPTO){
        $filterFacultades= UserFacultades::filterFacultades();
        if($level=self::LEVEL_FACULTAD){
             $this->alias('t')->andWhere(['in',
              't.codfac', $filterFacultades
               ]);  
         }else {
              $this->alias('t')->andWhere(['in',$filterFacultades,
              't.codfac',
               ])->andWhere(['t.coddepa'=>UserDepartamentos::filterDepartamentos]);   
       
        }
        
    }
    
    
   
    
    
   
   /*
    * Cada que se efectue una llamada a un SQL
    * Siempre filtrará los valores de facultagitdes 
    * asignados en la tabla 'userfacultades' a cada usuario
    * sin necesidad de escribir la condicion una y otra vez
    * Se vale de los valores  devueltos porla funcion 
    * UserFacultades::filterFacultades()
    */
   /* public function all($db = null)
    {
        $this->andWhere(
              ['in',
              'codfac', UserFacultades::filterFacultades()
               ]
               );
        return parent::all($db);
    }*/
    
    /*public function active()
        {
          return $this->andWhere(
              ['in',
              'codfac', UserFacultades::filterFacultades()
               ]
               );
        }*/
}


<?php
namespace frontend\modules\report\rules;

use yii\rbac\Rule;
use common\helpers\h;


/**
 * Checks if authorID matches user passed via params
 */
class ReportRule extends Rule
{
    public $name = 'allowRead';

    /**
     * @param string|int $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return bool a value indicating whether the rule permits the role or permission it is associated with.
     */
    
    
    
    public function execute($user, $item, $params)
    {
      /*
     * Verifica que el persmio pasado en la URL de la ruta 
       * tenga una cadena especificando el rol asignado a cada reporte 
       * Cada reporte tiene un campo donde almacena el nombre del rol 
       * que puede vsulizar o ejecutar el reporte 
       * Ejemplo:      make/creareporte?id=clientes&permiso=r_puede_leer
       * Se ejecuta el action creareporte obviamente con el persmiso
      * asignado , pero  ADICIONALMENTE  esta regla se dispará
       * verificando que el usuario que accedio a esta accion 
       * tenga el rol consignado en el registro del reporte (Campo: Role
       * del modelo Report)
       * 
     */
        return h::user()->can($params['permiso']);
        
        //return isset($params['post']) ? $params['post']->createdBy == $user : false;
    }
}

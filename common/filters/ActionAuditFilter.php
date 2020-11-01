<?php
/*
 * Clase creada por JRamírez 24/074/2020
 * Para registrar los actions en la auditoría
 * Anteriormente la auditorái solo registraba 
 * lso cambios en las tablas, con este filtro
 * podemos detectar los actions importantes 
 * registrados en cada controlador y poder
 * regiostrar auditoría, y rstrear no sólo los cambios 
 * en los datos, si no también las rutas o proced
 * efetuados por el usuario, siempre que estén
 * marcados como importantes. 
 */
namespace common\filters;
//use common\controllers\baseController;
use Yii;
use common\models\masters\Transacciones;
use common\models\audit\Activerecordlog;
use yii\base\ActionFilter;

class ActionAuditFilter extends ActionFilter
{
    

   

    public function beforeAction($action)
    {
        yii::error('before action');
        $this->logguearAction($action);
        return parent::beforeAction($action);
    }
    
    private function isRouteAuditable($action){
        //var_dump($uniqueId = $action->getUniqueId());
        //var_dump($this->owner->id);
         //var_dump($action->id);
        //die();
        
       // $route='/'.$this->owner->module->id.'/'.$this->owner->id.'/'.$action->id;
        //yii::error($route);
        $route='/'.$action->getUniqueId();
        //var_dump($route);die();
        
       return(is_null(Transacciones::findOne(['name'=>$route,'isauditable'=>'1'])))?false:true;  
    }
   
    private function logguearAction($action){
        yii::error('probando');
      if($this->isRouteAuditable($action)){
           yii::error('es ono ');
          $model=new  Activerecordlog();
         $model=$this->setLogValues($model, null);
        $model->save();
      }
       
    }
 
    public function setLogValues(&$model,$attribute,$delete=false){
        $model->setAttributes([
            'model'=>get_class($this->owner),
           // 'idModel'=>Json::encode($this->owner->getPrimaryKey(true)),
            'field'=>$attribute,
            'ip'=>trim(yii::$app->request->getRemoteIP()),
            'creationdate'=>date('Y-m-d H:i:s'),
            //'ip'=>yii::$app->request->getUrl(),
            'controlador'=>Yii::$app->controller->id,
            'description'=>Yii::$app->request->getUrl(),
            'nombrecampo'=>$attribute,
            'oldvalue'=>null,
            'newvalue'=>null,
             'username'=>yii::$app->user->identity->username, 
              'metodo'=> $this->getTypeRequest(),
               ]);
           $model->action=yii::t('base.labels','RUN');       
            return $model;
    }
    
    private function getTypeRequest(){
        if(yii::$app->request->isAjax) return 'AJAX';
        elseif(yii::$app->request->isPjax) return 'PAJAX';
        elseif(yii::$app->request->isGet) return 'GET';
        elseif(yii::$app->request->isPost) return 'POST';
        else return 'UNKNOWN';
    }
}


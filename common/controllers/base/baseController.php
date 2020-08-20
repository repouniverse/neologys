<?php
namespace common\controllers\base;
use common\models\base\modelBase;
use Yii;
use common\helpers\h;
use yii\web\Controller;
use yii\helpers\Html;
/**
 * CliproController implements the CRUD actions for Clipro model.
 */
class baseController extends Controller
{
   public $nameSpaces=[];
   
    /*
     * Estas constante son predefinidas en 
     * los widgets edit-xxx
     */
    const EDIT_HAS_EDITABLE='hasEditable';
    const EDIT_ARBITRARY='XXY4';
    const EDIT_EDITABLE_KEY='editableKey';
     const EDIT_EDITABLE_INDEX='editableIndex';
     const EDIT_EDITABLE_ATTRIBUTE='editableAttribute';  
    

 /*
  * Procedimiento para gestionar los POSTS Ajax
  * de los controles edit-Field, edit-column
  * Siempre invoque esta funcion dentro de los action
  * en las clases  hijas que reciban los valores POST 
  * de los Ajax de los widgets edit-xxxx
  */
 public function editField(){
       // var_dump($this->getNamespace($this->findKeyArrayInPost()));die();
     //var_dump(h::request()->post);die();
        $className=$this->getNamespace($this->findKeyArrayInPost());
      $model=$className::findOne( h::request()->post(static::EDIT_EDITABLE_KEY));
        // use Yii's response format to encode output as JSON
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model->{h::request()->post(static::EDIT_EDITABLE_ATTRIBUTE)}=h::request()->
                post($this->findKeyArrayInPost())[h::request()->
                post( static::EDIT_EDITABLE_INDEX  )][h::request()->post(static::EDIT_EDITABLE_ATTRIBUTE)];
     
         if ($model->load($_POST)) {        
        if ($model->save()) {
             return  \yii\helpers\Json::encode(['output'=>'OK', 'message'=>'SE EDITO SIN PROBLEMAS']);
             }
       else {
           RETURN  ['output'=>'Error', 'message'=>$model->getFirstError()];
        }}else {
             return ['output'=>'', 'message'=>''];
        }
   
  }
     
  /*
   * Verifica que el controlador esta recibiendo 
   * un POST AJAX de un widget edit-xxxx
   */
 public function is_editable(){
     return (!(h::request()->post(static::EDIT_HAS_EDITABLE,
            static::EDIT_EDITABLE_ATTRIBUTE)
            ===static::EDIT_EDITABLE_ATTRIBUTE)); 
 }
  
protected function getNamespace($modelclass){
$clase=null;
if(count($this->nameSpaces)==0)
    return $modelclass;
    //throw new \yii\base\Exception(Yii::t('base.errors', 'You should define  \'namespaces\'[]  property for this controller '));
         
       foreach($this->nameSpaces as $indice=>$namespace){
        if (class_exists($namespace."\\".$modelclass)){
           $clase=$namespace."\\".$modelclass; break;
        }
    }
    return $clase;
if($clase===null)
    throw new \yii\base\Exception(Yii::t('base.errors', 'No namespace found in namespaces[] property that matches with the {nombreclase}, please review this propertie ',['{nombreclase}'=>$modelclass]));
         
    
}

/*ENCUENTRA EL NOMBRE DEL MODELO
 * EN EL POST DEL AJAX ENVIADO POR
 * LOS WIDGETS EDIT-XXX
 */
    
private static function findKeyArrayInPost(){
     $arr=h::request()->post();
     $valor=null;
     foreach ($arr as $key=>$value){
         if(is_array($value)){
             $valor=$key;break;
         }             
     }
     return $valor;
 }    


 /*Cierra la ventana modal y refresca las
  * grillas de la ventana padres 
  * @nombremodal: Nombre de la ventana Modal
  * @grillas: Array con el nombre de las grillas
  */
 public function closeModal($nombremodal,$grillas=null){
     if(is_array($grillas)){
         \yii::error('1 cerrando el modal',__METHOD__);
         echo Html::script(" $('#".$nombremodal."').modal('hide');"); 
         foreach($grillas as $v=>$grilla){
           echo Html::script("window.parent.$.pjax({container: '#".$grilla."'});");   
         }
     
     }elseif(is_null($grillas)){
         \yii::error('2 cerrando el modal',__METHOD__);
        echo Html::script(" $('#".$nombremodal."').modal('hide');");   
     }else{
         \yii::error('3 cerrando el modal',__METHOD__);
        echo Html::script(" $('#".$nombremodal."').modal('hide'); "
             . "window.parent.$.pjax({container: '#".$grillas."'})"); 
     }
  
 }
 
 
 /*Esta función se encarga de establecer un contador 
  * para controlar como se van insertando lo items hijos 
  * mediante la sesion 
  */
 public function countDetail(){
  if(h::request()->isAjax){
      
                $contadorSession=h::session()->get($this->getNameSessionCounterDetail());
            if(is_null(($contadorSession))){//Si no existe crearlo y asignarle cero
                    h::session()->set($this->getNameSessionCounterDetail(),0);
                }else{//si existe incremenarle en uno
                    h::session()->set($this->getNameSessionCounterDetail(),
                    h::session()->get($this->getNameSessionCounterDetail())+1);
                    }
                    return h::session()->get($this->getNameSessionCounterDetail());
  }else{
      return 0;
  }
     
 }
 
 //borra la variable sesiondetail
 public function flushSessionDetail(){
      h::session()->remove($this->getNameSessionCounterDetail());
      return null;
 }
 
 //obitne un nombre de variable de sesin , basado en el id de susuario y nombre del controladopry el action
 private function getNameSessionCounterDetail(){
     return h::userId().'_detail';
    // return str_replace('/','',str_replace('\\','',h::userId().'_'.$this->id.$this->action->id));
 }
 
 
 public function actionSearchGeneral(){
     if(h::request()->isAjax){
         
         
         $valor= h::request()->post('searchTerm');
         if(is_null($valor) or empty($valor) or trim($valor)=="")            
           $resultados= Clipro::find()->select(['codpro as id','despro as text'])->where(['like','despro',$valor])->asArray()->all();
         else{
             $resultados=[];
         }
           echo  \yii\helpers\Json::encode($resultados);
           }
 }
 
 /*
  * Esta funcion es la que buscara 
  * valores en modelos  relacionados 
  * para el url del widget common\widgets\searchwidget\SearchWidget 
  * 
  */
 public function actionSearchByModel(){
     if(h::request()->isAjax && h::request()->isPost ){
        $modeloName= h::request()->post('modeloname');
        $valorClave=h::request()->post('valorclave');
         $campoClave=h::request()->post('campoclave');
         $modelo=$modeloName::find()->where(['=',$camoclave,$valorClave])->one();
        $resultados=$modelo->getAttributes();
         echo  \yii\helpers\Json::encode($resultados); 
     }
 }
 
 
 

 
 public function deleteModel($id,$modelClass){
     $datos=[];
	//$modelClass=unserialize(h::request()->get(static::NOMBRE_CLASE_PARAMETER));
       // $id=h::request()->get(static::ID_CLASE_PARAMETER);
        $model=$modelClass::findOne($id);
        if($model instanceof modelBase && !is_null($model)){
           
                if($model->hasChilds()){
                    $datos['error']=yii::t('base.errors','The record has Childs Records ');  
                }else{
                      try{ 
                             if($model->delete()<> false){
                                 $datos['success']=yii::t('base.errors','The record was deleted successfully...!');  
                            }
                          } catch (Exception $ex) {
                             $datos['error']=yii::t('base.errors','There are some troubles by deleting this record : {mensaje} ',['mensaje'=>$ex->getMessage()]);  
                
                            }
                }
              
        }else{
            if(is_null($model)){
                $datos['error']=yii::t('base.errors','Record not found for delete  for this key: {identidad} ',['identidad'=>$id]);  
             
            }else{
             $datos['error']=yii::t('base.errors','The class : "{clase}" is not Instance of "baseModel" ',['clase'=>$modelClass]);  
             
            }
             
                  
        }
           
    return $datos;
 }
 

 /*
 * Genera un array de objetos hijos y 
 * losprepara en el escenario indicado
 */
    public function generateItems(string $clase,$n,$escenario=null){
        $itemsp=[];
        for($i = 1; $i <= $n; $i++) {
             $itemsp[]=new $clase;         
           }
        if(!is_null($escenario)){
            foreach($itemsp as $item){
                $item->setScenario($escenario);
            }
        }
        return $itemsp;
    }
  
  
   /*
  * Esta funcion retorna un JSOn con respuesta de un error 
  * usarlo siempre que se necesite una accion ajax para borrar
  * un registro, se apoya en la funcion cruda deletemodel()
  * id: Clave principal
  * clase: Nombre de la clase a instnaciar
  * Retorna un array de errores en formato JSON
  */
  public function actionDeletemodelForAjax(){
        if(h::request()->isAjax){
           $id= h::request()->post('id');
          // var_dump(h::request()->post('modelito'));die();
           $clase=str_replace('@','\\',h::request()->post('modelito'));
          // var_dump(h::request()->post(),$id,$clase);die();
           $datos=$this->deleteModel($id, $clase);
           h::response()->format = \yii\web\Response::FORMAT_JSON;
           return $datos;
        }
    } 
    
    
}

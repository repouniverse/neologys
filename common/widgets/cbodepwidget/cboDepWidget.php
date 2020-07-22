<?php
namespace common\widgets\cbodepwidget;
use common\models\base\modelBase;
use yii\base\Widget;
use yii\web\View;
use yii\helpers\Json;
use yii\helpers\Url;
use yii;
use yii\base\InvalidConfigException;
class cboDepWidget extends \yii\base\Widget
{
    public $id;
    public $controllerName='finder';
    public $actionName='combodependiente';
    //public $actionNameModal='busquedamodal';
    public $model;//EL modelo
    public $form; //El active FOrm 
    public $campo;//el nombre del campo modelo
    public $idcombodep; //El id del comboa  aactuaklizar
    public $data=[];// data del combo box a renderizar
    public $idComboSource=null;
    /*
     * Esta 3 prpeidades definen de donde se sacaran los datos
     * tabla: 
     * 
     *                Table:  nameClass
     * -----------------------------------------------------
     *|   fieldKeyClass      |    fieldSecondClass    |    
     * -----------------------------------------------------
     *|        001           |         VALOR UNO      |
     *|        002           |         VALOR DOS      |
     */
   public $fieldKeyClass;//EL campo clave de la clase (nameClass)
   public $fieldSecondClass;//EL campo a mostrar  de la clase (nameClass)
   public $nameClass; //La clase de donde se extreran los datos
   private $_esdataremota=true; //Se saca data remora
   public $inputOptions=[];
   /*
    * 3 preopiedades para sacar los datos
    */
   public $source=[];
  
    //public $tabular=false; //Cuando se trata de renderizar en una grilla o tabala 
    //public $multiple=false; //si se puede seleccionar   mas de un valor 
   // public $foreignskeys=[2,3,4];//Orden de los campos del modelo foraneo 
    //que s evan a amostrar o renderizar en el forumlario eta propida debe de especficarse al momento de usar el widget 
    //private $_foreignClass; //nombe de la clase foranea
   // private $_foreignField; //nombre del campo foranea
    //private $_secondField=null; //el  nombde del campo oraneo a mosrtar en el comno
    //private $_varsJs=[];
    //public $ordenCampo=1; //EL campo a mostrar por el combo 
   // private $_modelForeign=null; //El obejto modelo foraneo
    
    public function init()
    {
       
        parent::init();
         $this->registerTranslations();
        // echo get_class($this->model);die();
        if(!($this->model instanceof modelBase))
        throw new InvalidConfigException('The "model" property is not subclass from "modelBase".');
        if(!($this->form instanceof \yii\widgets\ActiveForm))
        throw new InvalidConfigException('The "form" property is not subclass from "ActiveForm".'.get_class($this->form));
  if(empty($this->idcombodep ))
        throw new InvalidConfigException('The "idcombodep" property is empty.');
  
       
    }

    public function run()
    {
        
       
         // Register AssetBundle
        cboDepWidgetAsset::register($this->getView());
        $this->makeJs();
         return  $this->render('controls',[
                'model'=>$this->model,
                'form'=>$this->form,
                'campo'=>$this->campo,
               'inputOptions'=>$this->inputOptions,
                 //'esnuevo'=>$this->model->isNewRecord,
              // 'valoresLista'=>$this->getValoresList(),
               //'multiple'=>$this->multiple,
              'data'=>$this->data,
             'widget'=>$this
             // 'valores'=>$valores,
               // 'idcontrolprefix'=>$this->getIdControl(),
                ]);
        
        
        
        }
    
 private function makeJs(){
   $this->getView()->registerJs("$(document).ready(function() {
    $('#".$this->getIdControl()."').on('change',function(){
  var_filtro=$('#".$this->getIdControl()." option:selected').val();
     //alert(var_filtro);
  $.ajax({ 
   url:'".\yii\helpers\Url::toRoute('/'.$this->controllerName.'/'.$this->actionName)."',
   type:'post',
   dataType:'html',
   data:{isremotesource:'".$this->isSourceFromDb()."' ,filtro:var_filtro,source:".Json::encode($this->source)."},
   error:  function(xhr, status, error){ 
                            var n = Noty('id');                      
                             $.noty.setText(n.options.id,'<span class=\'glyphicon glyphicon-trash\'></span>      '+ xhr.responseText);
                              $.noty.setType(n.options.id, 'error');         
                                }, 
success: function (data) {// success callback function
           $('#".$this->idcombodep."').html(data);
    }
       }); //ajax 
        } //on change
    );//on change
     });",\yii\web\View::POS_END);
                        }     
        
   
   
   

   private function getIdControl(){
       if($this->idComboSource===null){
           return strtolower($this->getShortNameModel().'-'.$this->campo);
       }else{
           return $this->idComboSource;
       }
       
   }
      
  private function getShortNameModel(){
       $retazos=explode('\\',get_class($this->model));
      return $retazos[count($retazos)-1];
   }
  
  private function isSourceFromDb(){
      /*verificando la porpeada soruce */
      if(count($this->source)==0)
      return false;
      return (is_array(array_values($this->source)[0]))?'yes':'not';
  }
  
 
public function registerTranslations()
    {
        $i18n = Yii::$app->i18n;
        $i18n->translations['widgets/cbodep/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@common/widgets/cbodepwidget/messages',
            'fileMap' => [
                'widgets/cbodep/messages' => 'messages.php',
            ],
        ];
    }
  
 public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('widgets/cbodep/' . $category, $message, $params, $language);
    }  
}
?>
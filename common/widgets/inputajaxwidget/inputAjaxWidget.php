<?php
namespace common\widgets\inputajaxwidget;
//use common\models\base\modelBase;
use yii\base\Widget;
use yii\web\View;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\helpers\Html;
use yii;
use yii\base\InvalidConfigException;
class inputAjaxWidget extends \yii\base\Widget
{
    public $id;
    public $id_input=null;
    public $tipo='GET';
    public $ruta='';
    public $dataType='json';
    public $posicion=\yii\web\View::POS_END;
    //public $model=null;
    public $data=[];
    PUBLIC $isHtml=false;
    public $evento='change';
    public $idGrilla=null; //Ids de los contendeores pjax a refrescar
    public function init()
    {
       
        parent::init();
         //$this->registerTranslations();
    }

    public function run()
    {  // Register AssetBundle
        inputAjaxWidgetAsset::register($this->getView());
         if($this->isHtml){
             $this->makeJsHtml();
         }else{
              $this->makeJs();
         }
       
    }
    
    
    
 private function makeJsHtml(){
   $this->getView()->registerJs("$(document).ready(function() {
    $('#".$this->id_input."').on('".$this->evento."',function(){
    var_input=$('#".$this->id_input."').val();
  $.ajax({ 
   url:'".$this->ruta."',
   type:'".$this->tipo."',
   dataType:'html',
   data:{valorInput:var_input},
   error:function(xhr, status, error){ 
                            var n = Noty('id');                      
                             $.noty.setText(n.options.id,'<span class=\'glyphicon glyphicon-remove-sign\'></span>      '+ xhr.responseText);
                              $.noty.setType(n.options.id, 'error');         
                                }, 
success: function (data) {// success callback function
           $('#".$this->idGrilla."').html(data);
    }
       }); //ajax 
        } //on change
    );//on change
     });",$this->posicion);
 }
 
  private function makeJs(){
    $cadena="$(document).ready(function() {
    $('#".$this->id."').on('".$this->evento."',function(){
       //pichicho
  $.ajax({ 
   url:'".$this->ruta."',
   type:'".$this->tipo."',
   dataType:'".$this->dataType."',
   data:".Json::encode($this->data).",    
  error:  function(xhr, textStatus, error){               
                            var n = Noty('id');                      
                              $.noty.setText(n.options.id, error);
                              $.noty.setType(n.options.id, 'error');       
                                },  
            success: function(json) {  
                  
                        var n = Noty('id');
                       if ( !(typeof json['error']==='undefined') ) {
                      
                   $.noty.setText(n.options.id,'<span class=\'glyphicon glyphicon-remove-sign\'></span>      '+ json['error']);
                              $.noty.setType(n.options.id, 'error'); 
                              }
                         if ( !(typeof json['success']==='undefined') ) {
                                    
                                $.noty.setText(n.options.id,'<span class=\'glyphicon glyphicon-ok-sign\'></span>' + json['success']);
                             $.noty.setType(n.options.id, 'success');
                              } 
                               if ( !(typeof json['warning']==='undefined') ) {
                                        $.noty.setText(n.options.id,'<span class=\'glyphicon glyphicon-info-sign\'></span>' +json['warning']);
                             $.noty.setType(n.options.id, 'warning');
                            
                              
                              } 
                     $.pjax.reload({container: '#".$this->idGrilla."'});
                 }
       }); //ajax 
        })
    })";
    
    $cadena2="alert('hola compadre);";
   $this->getView()->registerJs($cadena,$this->posicion);
  }                       
   
   
   

      
  
 
 
}
?>
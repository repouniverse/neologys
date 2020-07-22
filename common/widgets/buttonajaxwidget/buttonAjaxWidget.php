<?php
namespace common\widgets\buttonajaxwidget;
//use common\models\base\modelBase;
use yii\base\Widget;
use yii\web\View;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\helpers\Html;
use yii;
use yii\base\InvalidConfigException;
class buttonAjaxWidget extends \yii\base\Widget
{
    public $id;
    public $tipo='GET';
    public $ruta='';
    public $dataType='json';
    public $posicion=\yii\web\View::POS_END;
    public $data=[];
    PUBLIC $isHtml=false;
    public $IdGrilla=null; //Ids de los contendeores pjax a refrescar
    public function init()
    {
       
        parent::init();
         $this->registerTranslations();
    }

    public function run()
    {  // Register AssetBundle
         buttonAjaxWidgetAsset::register($this->getView());
         if($this->isHtml){
             $this->makeJsHtml();
         }else{
              $this->makeJs();
         }
       
    }
    
    
    
 private function makeJsHtml(){
   $this->getView()->registerJs("$(document).ready(function() {
    $('#".$this->id."').on('click',function(){
  $.ajax({ 
   url:'".$this->ruta."',
   type:'".$this->tipo."',
   dataType:'html',
   data:".Json::encode($this->data).",
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
   $this->getView()->registerJs("$(document).ready(function() {
    $('#".$this->id."').on('click',function(){
  $.ajax({ 
   url:'".$this->ruta."',
   type:'".$this->tipo."',
   dataType:'html',
   data:".Json::encode($this->data).",
   error:function(xhr, status, error){ 
                            var n = Noty('id');                      
                             $.noty.setText(n.options.id,'<span class=\'glyphicon glyphicon-remove-sign\'></span>      '+ xhr.responseText);
                              $.noty.setType(n.options.id, 'error');         
                                }, 
success: function (data) {
               var n = Noty('id');
                       if ( !(typeof json['error']==='undefined') ) {
                                        $.noty.setText(n.options.id,'<span class=\'glyphicon glyphicon-trash\'></span>      '+ json['error']);
                              $.noty.setType(n.options.id, 'error'); 
                              }
                         if ( !(typeof json['success']==='undefined') ) {
                                        $.noty.setText(n.options.id, json['success']);
                             $.noty.setType(n.options.id, 'success');
                              } 
                               if ( !(typeof json['warning']==='undefined') ) {
                                        $.noty.setText(n.options.id, json['warning']);
                             $.noty.setType(n.options.id, 'warning');
                              } 
                              $.pjax.defaults.timeout = false;  
                              ".(is_null($this->idGrilla))?"//":""."$.pjax.reload({container: '".$this->idGrilla."'});
    }
       }); //ajax 
        } //on change
    );//on change
     });",$this->posicion);
  }                       
   
   
   

      
  
 
 
}
?>
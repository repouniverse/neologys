<?php
namespace common\widgets\linkajaxgridwidget;
use yii\base\Widget;
use yii;
use yii\web\View;
use yii\helpers\Json;
use yii\base\InvalidConfigException;
class linkAjaxGridWidget extends Widget
{
    public $id;
   public $idGrilla; //Id del sectro Pjax par arefrescar luego de la accion 
   public $otherContainers=[];
    public $evento; //tipode vento js : click, blur, change  etc
   public $family;    //familia de la clase del elemento HTML para tomarlo como selector
   public $type; //TIPO DE EVENTO AJAX  : GET POST 
   public $confirm=false; //SI VA A PREGUNTAR ANTES DE EJECUTAR
   public $question="Está seguro de efectuar esta acción?";
   public $mode='json'; //puede ser json, html
   public $data=[];//DATA DEL AJAX
     public $divReplace=null; //puede ser json, html
    public $posicion=View::POS_HEAD;
     //
   // private $_varsJs=[];
    
    public function init()
    {
        if($this->mode==='html'&& $this->divReplace===null)
        throw new InvalidConfigException(' NO existe n div pra recepcionar los resultados  ');
         
        if($this->type===NULL or !in_array($this->type,['POST','GET','post','get']))
        throw new InvalidConfigException(' The "Type" property is Null. Make sure wit should be  "POST" or "GET"  ');
         
        if($this->idGrilla===NULL)
        throw new InvalidConfigException('The "idGrilla" property is Null.');
        if($this->evento===NULL or !in_array($this->evento,['click','change']))
        throw new InvalidConfigException('The "evento" property is Null or not Valid');
  
        parent::init();
    }

    public function run()
    {
       if($this->mode=='json')
        $this->makeJs();
       if($this->mode=='html')
          $this->makeJsHtml(); 
        
    }
  private function makeJsHtml(){
       $cadenaJs="$('div[id=\"".$this->idGrilla."\"] [family=\"".$this->family."\"]').on( '".$this->evento."', function() { 
           $('#".$this->divReplace."').html('');
             $.ajax({
              url: this.title,
              type: '".$this->type."',
              data:JSON.parse(this.id) ,
              dataType: 'html',
               error:  function(xhr, textStatus, error){               
                            var n = Noty('id');                      
                              $.noty.setText(n.options.id, error);
                              $.noty.setType(n.options.id, 'error');       
                                }, 
              
              success: function(data) {
              $('#".$this->divReplace."').html(data);
             
                            }
                   
                       
                        });  "
            . "})";
    $this->getView()->registerJs($cadenaJs);    
  }
     
  private function makeJs(){
      $cad=" beforeSend: function() {  
             return confirm('".$this->question."');
                        },";
      $confirm=($this->confirm)?$cad:'';
     // $mesage=yii::t('base.verbs','Are you Sure to Delete this Record ?');
     $cadUx=(count($this->otherContainers)>0)?"  $.pjax.reload({container: '#".$this->otherContainers[0]."', async: false});  ":"";
   $cadenaJs="$('div[id=\"".$this->idGrilla."\"] [family=\"".$this->family."\"]').on( '".$this->evento."', function() { 
        // alert(this.title);
     var yapaso=false;
     
    if(!yapaso){  
$.ajax({
              url: this.title,
              
              type: '".$this->type."',
              data:".((count($this->data)==0)?'JSON.parse(this.id)':Json::encode($this->data)). "    ,
              dataType: 'json',".$confirm." 
               error:  function(xhr, textStatus, error){               
                            var n = Noty('id');                      
                              $.noty.setText(n.options.id, error);
                              $.noty.setType(n.options.id, 'error');       
                                }, 
              
              success: function(json) {
             
               //alert(typeof json['dfdfd']==='undefined');
                        var n = Noty('id');
                        
                           $.pjax.reload({container: '#".$this->idGrilla."', async: false});
                           ".$cadUx."  
                           
                             

                       if ( !(typeof json['error']==='undefined') ) {
                        $.noty.setText(n.options.id,'<span class=\'glyphicon glyphicon-remove\'></span>      '+ json['error']);
                              $.noty.setType(n.options.id, 'error');  
                          }    

                             if ( !(typeof json['warning']==='undefined' )) {
                        $.noty.setText(n.options.id,'<span class=\'glyphicon glyphicon-exclamation-sign\'></span>      '+ json['warning']);
                              $.noty.setType(n.options.id, 'warning');  
                             } 
                          if ( !(typeof json['success']==='undefined' )) {
                        $.noty.setText(n.options.id,'<span class=\'glyphicon glyphicon-ok\'></span>      '+ json['success']);
                              $.noty.setType(n.options.id, 'success');  
                             } 
                            
                            }
                                        
                        });  
                      yapaso=true; 
                     }      
                        })";
       
  // echo  \yii\helpers\Html::script($stringJs);
   $this->getView()->registerJs($cadenaJs,$this->posicion);
   // $this->getView()->registerJs($stringJs2);
                        }     
        
        
   
   
   
   
}

?>
<?php
namespace common\widgets\buttonsubmitwidget;
use yii\base\Widget;
use yii;
use yii\web\View;
use yii\helpers\Html;
use yii\base\InvalidConfigException;
class buttonSubmitWidget extends Widget
{
   const OP_PRIMERA=1;
   const OP_SEGUNDA=2;
    const OP_TERCERA=2;
    public $id;
   public $idGrilla=null; //Id del sectro Pjax par arefrescar luego de la accion 
    public $idForm=null; //NOMDE O ID DEL FOMRULARIO A hahacer submit
   public $idModal=null;    //id de la ventana MOdal
   public $url=null; //Direccion a la cual se redirecciona 
   public $title='Guardar';
   
    
    public function init()
    {
        
        if($this->url===NULL)
        throw new InvalidConfigException('The "url" property is Null.');
       if($this->idForm===NULL)
        throw new InvalidConfigException('The "idForm" property is Null.');
       
        if($this->idGrilla===NULL)
        throw new InvalidConfigException('The "idGrilla" property is Null.');
        if($this->idModal===NULL)
        throw new InvalidConfigException('The "idModal" property is Null or not Valid');
  
        parent::init();
    }

    public function run()
    {
       
        echo Html::button($this->title,['onclick'=>"psico_saves_widget()", 'class' => 'btn btn-success']);
        $this->makeJs();
        
        
    }
  
     
  private function makeJs(){
   $cadenaJs="function psico_saves_widget(){
        var \$formulario=$('#".$this->idForm."');       
        $.ajax({
            url:'".$this->url."',
            type: 'post',
            data:\$formulario.serialize(),
            success: function(data){
               if(data.success=='1') {
                   if(data.type==1) {
                       $('#".$this->idModal."').modal('hide');
                        $.pjax.reload('#".$this->idGrilla."');
                    }else{
                          $('#".$this->idModal."').modal('hide');
                                $.pjax.reload({container: '#".$this->idGrilla."',timeout:6000});
                     }
               }
               if(data.success=='3'){
                      var msg=data.msg;
                      var n = Noty('id');
                        $.noty.setText(n.options.id,'<span class=\'glyphicon glyphicon-trash\'></span>      '+ msg);
                        $.noty.setType(n.options.id, 'error'); 
                    }
               if(data.success=='2') {
                   var msg=data.msg;
                   if(msg){
                       $.each(msg,function(key,val){
                           var div=$('.field-'+key);
                           div.addClass(' has-error');
                           div.find('.help-block').html(val);
                       });
                   }
               }
            }
              });
    }";
   $this->getView()->registerJs($cadenaJs, \yii\web\View::POS_HEAD);
  } 
}

?>
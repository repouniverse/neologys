<?php
//use kriss\calendarSchedule\CalendarScheduleWidget;
use common\widgets\calendarWidget\CalendarScheduleWidget;
use frontend\modules\inter\Module as m;
use yii\web\JsExpression;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\h;
//use yii\grid\GridView;
//use frontend\modules\sta\staModule;
use yii\widgets\Pjax;
use frontend\modules\sta\staModule;
/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Talleres */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="borereuccess">   
  <div class="box-body">               
<?php
$citasPendientes[]=[];
$alumno=$model->convocado->alumno;
$codalu=$alumno->codalu;
  ?>
        
            
   <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
 
 <?PHP     
$jsRemoveCallback = <<<JS
function(title) {
  console.log('removeCallback', title);
}
JS;

$jsCreateCallback = <<<JS
function(title, color) {
  console.log('createCallback', title, color);
}
JS;
echo CalendarScheduleWidget::widget([
    'defaultEventDuration'=>30,
    'draggableEvents' => [
        'items' => /*$items,/**/[
            ['name' => 'Lunes', 'color' => '#ea59df'],
           
            
        ],
        'removeCallback' => new JsExpression($jsRemoveCallback)
    ],
    'createEvents' => [
        'colors' => ['#286090', '#5cb85c', '#5bc0de', '#f0ad4e', '#d9534f'],
        'createCallback' => new JsExpression($jsCreateCallback)
    ],
    'fullCalendarOptions' => [
        'minTime'=>"08:00:00",
        'maxTime'=>"19:00:00",
        
       /*  'validRange'=>[
                'start'=>'2019-11-05',
                'end'=>'2019-11-19'
                ],*/
        //'formatDate'=>'dd/mm/yyyy',
         'locale'=>'es',
        
       'events' => $eventosHorarios,
        
        /*'events' => [
            ['title' => 'evento 1', 'start' => date('Y-m-d 10:00:00'), 'end' => date('Y-m-d 20:00:00'), 'color' => '#286090'],
            ['title' => 'evento 2', 'start' => date('Y-m-10 10:00:00'), 'allDay' => true, 'color' => '#5bc0de'],
        ],*/
        
        
        
        'eventReceive' => new JsExpression('function(event, delta,minuteDelta, revertFunc) {
       if (confirm("'.yii::t('sta.labels','¿Confirmar que desea crear esta Cita ?').'")) {
                  var fechainicio=event.start.format("YYYY-MM-DD HH:mm:ss");
        $.ajax({ 
                    method:"get",    
                    url: "'.\yii\helpers\Url::toRoute('/sta/programas/make-cita-by-student').'",
                    delay: 250,
                        data: {id:'.$model->id.', fecha:fechainicio,codalu:event.title  },
             error:  function(xhr, textStatus, error){               
                           // revertFunc();
                                }, 
              success: function(json) {  
                        var n = Noty("id");
                       if ( !(typeof json["error"]==="undefined") ) {
                       //revertFunc();
                   $.noty.setText(n.options.id,"<span class=\'glyphicon glyphicon-remove-sign\'></span>      "+ json["error"]);
                              $.noty.setType(n.options.id, "error"); 
                              }
                         if ( !(typeof json["success"]==="undefined") ) {
                                        $.noty.setText(n.options.id,"<span class=\'glyphicon glyphicon-ok-sign\'></span>" + json["success"]);
                             $.noty.setType(n.options.id, "success");
                              } 
                               if ( !(typeof json["warning"]==="undefined") ) {
                                        $.noty.setText(n.options.id,"<span class=\'glyphicon glyphicon-info-sign\'></span>" +json["warning"]);
                             $.noty.setType(n.options.id, "warning");
                              } 
                              
                      
                        },
   cache: true
  })
        }else{
      //revertFunc();
      }
                             
                                    }'),
        'eventDrop' => new JsExpression('function(event, delta,revertFunc) {
           
       if(event.title=="'.$codalu.'"){
       if (confirm("'.yii::t('sta.labels','¿Confirmar que desea hacer esta operación ?').'")) {
                  var fechainicio=event.start.format("YYYY-MM-DD HH:mm:ss");
                   var fechatermino=event.end.format("YYYY-MM-DD HH:mm:ss");
        $.ajax({ 
                    method:"get",    
                    url: "'.\yii\helpers\Url::toRoute(['/sta/citas/reprograma-cita']).'",
                    delay: 250,
                        data: {idcita:event.id, finicio:fechainicio,ftermino:fechatermino },
             error:  function(xhr, textStatus, error){               
                           var n = Noty("id");                      
                            $.noty.setText(n.options.id, "No se completó la operación,refresque la página e intente nuevamente");
                             
                              $.noty.setType(n.options.id, "error"); 
                                }, 
              success: function(json) {  
                        var n = Noty("id");
                       if ( !(typeof json["error"]==="undefined") ) {
                      //revertFunc();
                   $.noty.setText(n.options.id,"<span class=\'glyphicon glyphicon-remove-sign\'></span>      "+ json["error"]);
                              $.noty.setType(n.options.id, "error"); 
                              }
                         if ( !(typeof json["success"]==="undefined") ) {
                                        $.noty.setText(n.options.id,"<span class=\'glyphicon glyphicon-ok-sign\'></span>" + json["success"]);
                             $.noty.setType(n.options.id, "success");
                              } 
                               if ( !(typeof json["warning"]==="undefined") ) {
                                        $.noty.setText(n.options.id,"<span class=\'glyphicon glyphicon-info-sign\'></span>" +json["warning"]);
                             $.noty.setType(n.options.id, "warning");
                              } 
                              
                      
                        },
   cache: true
  })
        }else{
     // revertFunc();
      }
                             
                        }else{
      alert("No puede editar citas que no pertenezcan a este alumno");   
      }
}'),
        
        /*evento resize*/
        'eventResize' => new JsExpression('function(event, delta, revertFunc) {
               if(event.title=="'.$codalu.'"){
                   // alert(event.title + " SE MOVIO A     INICIO->" + event.start.format("YYYY-MM-DD H:m:s")+ "   FIN  -> "+event.end.format("YYYY-MM-DD HH:mm:ss") );
                    if (confirm("'.yii::t('sta.labels','¿Confirmar que desea cambiar la duración de esta cita ?').'")) {
                               var fechainicio=event.start.format("YYYY-MM-DD HH:mm:ss");
                               var fechatermino=event.end.format("YYYY-MM-DD HH:mm:ss");
                               // alert(event.start.format("YYYY-MM-DD HH:mm:ss"));
                                // alert(event.end.format("YYYY-MM-DD HH:mm:ss"));
                               //alert(event.id);
        $.ajax({ 
                    method:"get",    
                    url: "'.\yii\helpers\Url::toRoute(['/sta/citas/reprograma-cita']).'",
                    delay: 250,
                        data: {idcita:event.id, finicio:fechainicio ,ftermino:fechatermino},
             error:  function(xhr, textStatus, error){               
                           var n = Noty("id");                      
                              $.noty.setText(n.options.id, "No se completó la operación,refresque la página e intente nuevamente");
                              $.noty.setType(n.options.id, "error");
                                }, 
              success: function(json) {  
                        var n = Noty("id");
                       if ( !(typeof json["error"]==="undefined") ) {
                      //revertFunc();
                   $.noty.setText(n.options.id,"<span class=\'glyphicon glyphicon-remove-sign\'></span>      "+ json["error"]);
                              $.noty.setType(n.options.id, "error"); 
                              }
                         if ( !(typeof json["success"]==="undefined") ) {
                                        $.noty.setText(n.options.id,"<span class=\'glyphicon glyphicon-ok-sign\'></span>" + json["success"]);
                             $.noty.setType(n.options.id, "success");
                              } 
                               if ( !(typeof json["warning"]==="undefined") ) {
                                        $.noty.setText(n.options.id,"<span class=\'glyphicon glyphicon-info-sign\'></span>" +json["warning"]);
                             $.noty.setType(n.options.id, "warning");
                              } 
                              
                      
                        },
   cache: true
  })
        }else{
      //revertFunc();

                            } } else{
                             alert("No puede editar citas que no pertenezcan a este alumno");  
                            }
                  }'),
        /*fin del veno resize*/
        
        
        /*evento Click*/
        'eventClick' => new JsExpression('function(event) {'
                . 'if (confirm("'.yii::t('sta.labels','¿Confirmar que desea editar la cita ?').'")) {
                 var url = "sta/citas/update?id="+event.id; // t
          var abso="'.\yii\helpers\Url::home(true).'";
              window.open(abso+url);
          //window.location=abso+url;
                }'
                . '}'),
    ]
]);?>
 </div>  


    
        
</div>
    </div>

<?php
use common\widgets\calendarWidget\CalendarScheduleWidget;
use yii\web\JsExpression;
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\modules\inter\models\InterEntrevistas;
use yii\widgets\ActiveForm;
use common\helpers\h;
use yii\grid\GridView;
use yii\widgets\Pjax;
use frontend\modules\inter\Module as m;
use common\widgets\buttonajaxwidget\buttonAjaxWidget;
/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Talleres */
/* @var $form yii\widgets\ActiveForm */
?>
<br>
<BR>

<div class="box box-success">
<div class="box-body">
<?php 
/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Talleres */
ECHO \common\widgets\spinnerWidget\spinnerWidget::widget();
/* @var $this yii\web\View */
/* @var $model frontend\modules\inter\models\InterConvocados */

$this->title = m::t('labels', 'Fill in personal data : {name}', [
    'name' => $model->persona->fullName(),
]);
//$this->params['breadcrumbs'][] = ['label' => substr($model->programa->descripcion,0,10), 'url' => ['/inter/programa/update', 'id' => $model->programa->id]];
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'My panel'), 'url' => [h::user()->resolveUrlAfterLogin()]];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
///$this->params['breadcrumbs'][] = Yii::t('base_labels', 'Update');
?>



 




  
   
      <?php 
$plan=$current_expediente->plan;

echo $this->render('@frontend/modules/inter/views/convocados/_progress_convocado',['identidad'=>$model->persona->identidad]);
?>  
     <?php  Pjax::begin(['id'=>'estado-label','timeout'=>false]);  ?> 
    <div style="margin-top:2px;">.</div>
    <h4><?=m::t('labels','Current Step')."  :  ".h::space(10).$plan->descripcion?></h4>
    
    <br>
        
    
    
    <?php if($modelEntrevista= $current_expediente->hasEntrevista()){ ?>
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
     <?php $tipo=($modelEntrevista->asistio)?'info':'warning';   ?>   
     <?php $mensaje=($modelEntrevista->asistio)?m::t('validaciones','You already passed the interview'):
             m::t('validaciones','You have an interview {numero} scheduled at {fecha}',['numero'=>$modelEntrevista->numero,'fecha'=>$modelEntrevista->fechaprog]);   ?>   
    <div class=" aviso-<?=$tipo?> ">
        <?php
        echo m::t('labels',$mensaje); 
        
        ?>
    </div>
   </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
         <?php 
         $url=Url::to(['/inter/expedientes/modal-view-horarios','id'=>$plan->id]);
         $options=['data-pjax'=>'0','class'=>'botonAbre','gridName'=>'PjaxCalendar','idModal'=>'buscarvalor' ];
         echo Html::a('<span class="btn btn-danger btn-sm" ><span class="fa fa-calendar"></span>  '.m::t('labels','View Schedules').'</span></span>', $url,$options);
        ?>  

    </div>
    
 <?php }else{ ?>
    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
        
    <div class=" aviso-danger ">
        <?php echo m::t('validaciones','You don\'t have an interview scheduled yet'); ?>
    </div>
   </div>
    <?php } ?>
    <?php  Pjax::end();  ?> 
    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
    .
    </diV>
    
    
    
    
        
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
       <?php
    $gridColumns=[
            
         
         [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{view}',
                'buttons' => [
                    'update' => function($url, $model) {
                     
                          $url= \yii\helpers\Url::toRoute(['update','id'=>$model->id]);
                        $options = [
                            'data-pjax'=>'0',
                            'target'=>'_blank',
                            'title' => Yii::t('base.verbs', 'Editar'),                            
                        ];
                        return Html::a('<span class="btn btn-danger btn-sm glyphicon glyphicon-pencil"></span>', $url, $options);
                      
                        
                     }
                        ,
                          'view' => function($url, $model) {  
                             $url= \yii\helpers\Url::toRoute(['view','id'=>$model->id]);
                       
                              $options = [
                            'data-pjax'=>'0',
                            'target'=>'_blank',
                            'title' => m::t('verbs', 'View'),                            
                        ];
                        return Html::a('<span class="btn btn-warning btn-sm glyphicon glyphicon-search"></span>', $url, $options);
                      
                        
                        
                        },
                         
                    ]
                ],
                
         [ 'attribute' => 'numero',
            
             ],
        [ 'attribute' => 'fechaprog',
             ],
            // 'alumno.celulares', 
             // 'alumno.correo', 
           [ 'attribute' => 'plan',
                'format'=>'raw',
                   'value'=>function($model){
                  return $model->expediente->plan->descripcion;         
                }
             ],
           [
           'attribute' => 'check',
           'format'=>'raw',
          'value'=>function($model){
                 if($model->asistio)
                  return '<i style="font-size:20px; color:#60a917;">'.h::awe('check').'</i>';         
                }
           ],
           
      
            
           
        ];
    
    ?>
 
 

         

    
    <h4><?=m::t('labels','History interviews')?></h4>  

    <?php Pjax::begin(['id'=>'listado_asistencias', 'timeout'=>false]); ?>
   
    <?= GridView::widget([
        'dataProvider' =>NEW  \yii\data\ActiveDataProvider([
            'query'=>InterEntrevistas::find()->andWhere([
                'convocado_id'=>$model->id,
            ])->orderBy(['fechaprog'=>SORT_ASC]),
        ]),
         'summary' => '',
         'tableOptions'=>['class'=>'table no-margin'],
        //'filterModel' => $searchModel,
        'columns' => $gridColumns,
    ]); ?>
        
   <?php Pjax::end(); ?>     

 
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
   
   <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title"><?=m::t('labels','Instructions')?></h3>
            </div>
            <div class="panel-body">
                <?php
        echo m::t('labels','Para programar  una cita '
                . 'arrastra la etiqueta roja donde aparece tu '
                . 'código, sólo aceptará en los horarios '
                . 'de color amarillo.'); 
        
        ?>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" >Tu cita <i style="font-size:18px;color:red"><span class="fa fa-circle"></span></i> 
                </div>
                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" >Horarios disponibles <i style="font-size:18px;color:yellow"><span class="fa fa-circle"></span></i> 
                </div >
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">Otras Citas <i style="font-size:18px;color:orange"><span class="fa fa-circle"></span></i> 
                </div>
            </div>
   </div>
      
      
      
   <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
 
 <?PHP   
 $codalu=$identidad->{$identidad->nameFieldCode()};
 
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
//$modelPsico=$model->tallerdet->tallerPsico();

//$codalu=$model->tallerdet->codalu;
Pjax::begin(['id'=>'mi-calendario','timeout'=>false]);
echo CalendarScheduleWidget::widget([
    'defaultEventDuration'=>'00:60',
    'draggableEvents' => [
         'items' => [
             ['name' =>$codalu , 'color' => '#ff0000'],
                  ],
        'removeCallback' => new JsExpression($jsRemoveCallback)
    ],
    'createEvents' => [
        'colors' => ['#286090', '#5cb85c', '#5bc0de', '#f0ad4e', '#d9534f'],
        'createCallback' => new JsExpression($jsCreateCallback)
    ],
    'fullCalendarOptions' => [
        'slotEventOverlap'=>false,
        //'defaultView'=>'week',
        'minTime'=>"07:00:00",
        'maxTime'=>"21:00:00",
       /*  'validRange'=>[
                'start'=>'2019-11-05',
                'end'=>'2019-11-19'
                ],*/
        //'formatDate'=>'dd/mm/yyyy',
         'locale'=>'es',
        
       'events' => array_merge($plan->eventsToCalendar(),$eventos),
        
        /*'events' => [
            ['title' => 'evento 1', 'start' => date('Y-m-d 10:00:00'), 'end' => date('Y-m-d 20:00:00'), 'color' => '#286090'],
            ['title' => 'evento 2', 'start' => date('Y-m-10 10:00:00'), 'allDay' => true, 'color' => '#5bc0de'],
        ],*/
        
      
        
        'eventReceive' => new JsExpression('function(event, delta,minuteDelta, revertFunc) {
      
if (confirm("'.yii::t('sta.labels','¿Confirmar que desea crear esta Cita ?').'")) {
                  var fechainicio=event.start.format("YYYY-MM-DD HH:mm:ss");
        $.ajax({ 
                    method:"get",    
                    url: "'.\yii\helpers\Url::toRoute('/inter/convocados/make-cita-by-expediente').'",
                    delay: 250,
                        data: {id:'.$current_expediente->id.', fecha:fechainicio,codalu:event.title  },
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
                             $.pjax.reload({container: "#estado-label", async:false});
                              $.pjax.reload({container: "#listado_asistencias", async:false});
                            $.pjax.reload({container: "#mi-calendario", async:false});
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
                    url: "'.\yii\helpers\Url::toRoute(['/inter/convocados/reprograma-cita']).'",
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
                              
                                $.pjax.reload({container: "#estado-label", async:false});
                                $.pjax.reload({container: "#listado_asistencias", async:false});
                                $.pjax.reload({container: "#mi-calendario", async:false});
                      
                        },
   cache: true
  })
        }else{
     // revertFunc();
      }
                             
                        }else{
      alert("No puede editar citas que no pertenezcan a esta persona");   
      }
}'),
        
     
        /*fin del veno resize*/
        
        
        /*evento Click*/
    
        
        
        
    ]
]); 

Pjax::end();


?>
 
        
</div>
    </div>
        </div>
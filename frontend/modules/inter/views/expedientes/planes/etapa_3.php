<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use frontend\modules\inter\Module as m;
    use yii\helpers\Url;
    use yii\grid\GridView;
    use yii\widgets\Pjax;
    use common\helpers\h;
  
    use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
    use common\helpers\ComboHelper;

    use common\models\masters\Alumnos;
?>
<div class="inter-convocados-form">
    <div class="box-body">
       <?php echo $this->render('encabezado',['model'=>$model,'identidad'=>$identidad]); ?>
    </div>
   
    <?php 
           $form = ActiveForm::begin
                    (
                        [
                            'id'=>'biForm',
                            //'fieldClass'=>'\common\components\MyActiveField',
                        ]
                    ); 
        ?>
    
    <?php Pjax::begin(['id'=>'PjaxCalendar','timeout'=>false]); ?>
    <?php  /*
     * haciendo equivalencias para aprovechar la 
     * vista 
     */
    $current_expediente=$model;
    $model=$convocado;
    $model->createExpedientes($model->currentStage());
     $eventos=$current_expediente->plan->populateEventosToCalendar();
    $eventos=$current_expediente->plan->populateEventosToCalendar();
    $eventos=$current_expediente->putColorEventsCalendar($eventos);
   ?>
 <?php if($modelEntrevista= $current_expediente->hasEntrevista()){ ?>
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
     <?php $tipo=($modelEntrevista->asistio)?'info':'warning';   ?>   
     <?php $mensaje=($modelEntrevista->asistio)?m::t('labels','This person has already been interviewed'):
             m::t('labels','This person has an interview {numero} scheduled at {fecha}',['numero'=>$modelEntrevista->numero,'fecha'=>$modelEntrevista->fechaprog]);   ?>   
    <div class=" aviso-<?=$tipo?> ">
        <?php
        echo m::t('labels',$mensaje); 
        
        ?>
    </div>
   </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
         <?php  
         $url=Url::to(['/inter/expedientes/modal-edit-entrevista','id'=>$modelEntrevista->id]);
         $options=['data-pjax'=>'0','class'=>'botonAbre','gridName'=>'PjaxCalendar','idModal'=>'buscarvalor' ];
         ?>
         <?= Html::a('<span class="btn btn-danger btn-sm" ><span class="fa fa-calendar"></span>  '.m::t('labels','Edit Interview').'</span></span>', $url,$options); ?>  
          <?php 
          $url=Url::to(['/inter/programa/view-plan','id'=>$current_expediente->plan_id]);
           $options=['data-pjax'=>'0','target'=>'_blank'];
          echo Html::a('<span class="btn btn-success btn-sm" ><span class="fa fa-calendar"></span>  '.m::t('labels','Schedules').'</span></span>', $url,$options);
          ?>  

    </div>
    
 <?php }else{ ?>
    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
        
    <div class=" aviso-danger ">
        <?php echo m::t('errors','This person does not have an interview scheduled yet'); ?>
    </div>
   </div>
    <?php } ?>
    
    <?php Pjax::end(); ?>
    
    <?php
   
    echo $this->render('/convocados/view_tab_calendar',[
     
         'current_expediente'=>$current_expediente,
         'eventos'=>$eventos,
         'model' =>$model ,
         'persona'=>$persona,
         'identidad'=>$identidad   
    ]);
    ?>
    
    
    
       <?PHP echo $this->render('@frontend/views/comunes/adjuntos', [
                        'model' => $current_expediente,
                 //'allowedExtensions' => $allowedExtensions,
                        //'vendorsForCombo' => $vendorsForCombo,
            ]);  ?> 
    
    <?php ActiveForm::end(); ?>
        
</div>

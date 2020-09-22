<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\widgets\ActiveForm;
use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
use frontend\modules\inter\helpers\comboHelper;
use frontend\modules\inter\Module as m;
use common\widgets\selectwidget\selectWidget;
use common\widgets\buttonajaxwidget\buttonAjaxWidget;
//use frontend\modules\sigi\models\SigiUnidades;
use kartik\date\DatePicker;
use yii\widgets\Pjax;
 use common\helpers\h;
/* @var $this yii\web\View */
/* @var $model frontend\modules\sigi\models\SigiTransferencias */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sigi-transferencias-form">
    
    <br>
    <?php $form = ActiveForm::begin([
    'fieldClass'=>'\common\components\MyActiveField',
     //'enableAjaxValidation'=>true,
    ]); ?>
      <div class="box-header">
        <div class="col-md-12">
            <div class="form-group no-margin">
                
        <?= Html::submitButton('<span class="fa fa-save"></span>   '.m::t('labels', 'Save'), ['class' => 'btn btn-success']) ?>
          <?= ($model->isNewRecord)?'':common\widgets\auditwidget\auditWidget::widget(['model'=>$model])
                ?> 
                <?php //echo  Html::a(m::t('labels', 'Create Foreign Person'), ['create-foreign-person'], ['class' => 'btn btn-warning']) ?>
            <?= Html::button('<span class="fa fa-check"></span>   '.m::t('labels', 'Register invited Teacher'), ['id'=>'btn-register','class' => 'btn btn-warning']) ?>
           

            </div>
        </div>
    </div>
     <?php  Pjax::begin(['id'=>'america']); Pjax::end();  ?>
      <div class="box-body">
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
     <?= $form->field($model, 'id')->label(m::t('labels','Current Period'))->textInput(['disabled' => true,'value'=>$programa->codperiodo]) ?>

 </div>
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
     <?= $form->field($model, 'id')->label(m::t('labels','Current Program'))->textInput(['disabled' => true,'value'=>$programa->descripcion]) ?>

 </div> 
 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
     <?= $form->field($model, 'docenteinv_id')->textInput(['disabled' => true,'value'=>$model->docenteinv->fullName()]) ?>

 </div>
 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
     <?= $form->field($model, 'universidad_id')->label(m::t('labels','University'))->textInput(['disabled' => true,'value'=>$model->universidad->nombre]) ?>

 </div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
     <?= $form->field($model, 'facultad_id')->label(m::t('labels','Faculty'))->textInput(['disabled' => true,'value'=>$model->facultad->desfac]) ?>

 </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      
                    <?php 
                        echo selectWidget::widget
                             (
                                [
                                    'model'=>$model,
                                    'form'=>$form,
                                    'campo'=>'docenteanfi_id',
                                    'ordenCampo'=>4,
                                    'addCampos'=>[8,9],
                                ]
                            );                
                    ?>
                
 </div>        
          
          
   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <?php 
                        echo selectWidget::widget
                             (
                                [
                                    'model'=>$model,
                                    'form'=>$form,
                                    'campo'=>'evento_id',
                                    'ordenCampo'=>6,
                                    'addCampos'=>[7,8],
                                ]
                            );                
                    ?>
 </div> 
   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
     <?= $form->field($model, 'descripcion')->textInput([]) ?>

 </div> 
          
          
          
   <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> 
    <?php /*echo ComboDep::widget([
               'model'=>$model,               
               'form'=>$form,
               'data'=> comboHelper::getCboUniversidades(),
               'campo'=>'universidad_dest',
               'idcombodep'=>'interinvitaciones-facultad_dest',
               
                   'source'=>[\common\models\masters\Facultades::className()=>
                                [
                                        'campoclave'=>'id' , //columna clave del modelo ; se almacena en el value del option del select 
                                        'camporef'=>'desfac',//columna a mostrar 
                                        'campofiltro'=>'universidad_id'  
                                ]
                                ],
                            ]
               
               
        ) */ ?>
 </div> 

 <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> 
     
    <?php
   /* $data=($model->isNewRecord)?[]:comboHelper::getCboFacultades($model->universidad_id);
   echo ComboDep::widget([
               'model'=>$model,               
               'form'=>$form,
               'data'=> $data,
               'campo'=>'facultad_dest',
               'idcombodep'=>'interinvitaciones-carrera_dest',
               
                   'source'=>[\common\models\masters\Carreras::className()=>
                                [
                                        'campoclave'=>'id' , //columna clave del modelo ; se almacena en el value del option del select 
                                        'camporef'=>'nombre',//columna a mostrar 
                                        'campofiltro'=>'facultad_id'  
                                ]
                                ],
                            ]
               
               
        ) */ ?>
     </div> 
     <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> 
     
    <?php
   /* $data=($model->isNewRecord)?[]:comboHelper::getCboCarreras($model->facultad_dest);
   echo  $form->field($model, 'carrera_dest')->
            dropDownList($data,
                  ['prompt'=>'--'.m::t('base.verbs','Seleccione un valor')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    ) */?>
  
     </div> 


   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <?= $form->field($model, 'detalles')->textArea([]) ?>

 </div>        
     
    <?php ActiveForm::end(); ?>

</div>
    </div>
<?php echo buttonAjaxWidget::widget(
       [  
            'id'=>'btn-register',
            'idGrilla'=>'america',
            'ruta'=>Url::to(['/inter/convocados/ajax-register-doce','id'=>$model->docenteinv_id]),          
           //'posicion'=> \yii\web\View::POS_END           
        ]  
   );   ?>
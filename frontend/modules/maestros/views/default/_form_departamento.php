<?php
//use kartik\typeahead\Typeahead;
use yii\helpers\Url;
use common\helpers\h;
//use common\models\masters\Personas;
use common\helpers\ComboHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
 //use kartik\date\DatePicker;
 use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
use frontend\modules\maestros\MaestrosModule as m;
/* @var $this yii\web\View */
/* @var $model common\models\masters\Trabajadores */
/* @var $form yii\widgets\ActiveForm */
?>



    <?php $form = ActiveForm::begin([
    'id' => 'alumnos-form',
    'enableAjaxValidation' => true,
    'fieldClass' => 'common\components\MyActiveField',
    //'options'=>['enctype' => 'multipart/form-data'],'fieldClass' => '\common\components\MyActiveField'
    ]); ?>
    
  <div class="box-body">  
    <div class="box-header">
        <div class="col-md-12">
            <div class="form-group no-margin">
                <?= Html::submitButton(m::t('verbs', 'Save'), ['class' => 'btn btn-success']) ?>
             <?=($model->isNewRecord)?'':common\widgets\auditwidget\auditWidget::widget(['model'=>$model])?>
       
            </div>
        </div>
    </div>
    
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> 
    <?= ComboDep::widget([
               'model'=>$model,               
               'form'=>$form,
               'data'=> ComboHelper::getCboUniversidades(),
               'campo'=>'universidad_id',
               'idcombodep'=>'departamentos-facultad_id',               
                   'source'=>[\common\models\masters\Facultades::className()=>
                                [
                                  'campoclave'=>'facultad_id' , //columna clave del modelo ; se almacena en el value del option del select 
                                        'camporef'=>'desfac',//columna a mostrar 
                                        'campofiltro'=>'universidad_id'  
                                ]
                                ],
                            ]
               
               
        )  ?>
 </div>       
  
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">    
 <?= $form->field($model, 'facultad_id')->
            dropDownList(($model->isNewRecord)?[]:ComboHelper::getCboFacultades($model->universidad_id),
                  ['prompt'=>'--'.m::t('verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    ) ?>
 </div>  
    
    
    
    
    
    
    
    
   
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'nombredepa')->textInput(['maxlength' => true]) ?>
  </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    
    <?= $form->field($model, 'correodepa')->textInput(['maxlength' => true]) ?>
</div>
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    
    <?= $form->field($model, 'detalles')->textArea([]) ?>
</div>   
        
   
   
 
   
    
    

    
   
    <?php ActiveForm::end(); ?>

  </div>
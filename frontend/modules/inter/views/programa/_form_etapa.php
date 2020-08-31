<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\widgets\ActiveForm;
use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
use frontend\modules\inter\helpers\comboHelper;
use frontend\modules\inter\Module as m;
//use frontend\modules\sigi\models\SigiUnidades;
 //use kartik\date\DatePicker;
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
            

            </div>
        </div>
    </div>
      <div class="box-body">

   <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> 
    <?= ComboDep::widget([
               'model'=>$model,               
               'form'=>$form,
               'data'=> comboHelper::getCboProgramas(),
               'campo'=>'programa_id',
               'idcombodep'=>'interetapas-modo_id',
               
                   'source'=>[\frontend\modules\inter\models\InterModos::className()=>
                                [
                                        'campoclave'=>'id' , //columna clave del modelo ; se almacena en el value del option del select 
                                        'camporef'=>'descripcion',//columna a mostrar 
                                        'campofiltro'=>'programa_id'  
                                ]
                                ],
                            ]
               
               
        )  ?>
 </div> 

 <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> 
     
    <?php
    $data=($model->isNewRecord)?[]:comboHelper::getCboModos($model->programa_id);
   echo  $form->field($model, 'modo_id')->
            dropDownList($data,
                  ['prompt'=>'--'.m::t('base.verbs','Seleccione un valor')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    ) ?>
  
     </div> 

 
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

 </div>
  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'activo')->checkbox() ?>

 </div>
  
   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <?= $form->field($model, 'comentarios')->textArea([]) ?>

 </div>        
     
    <?php ActiveForm::end(); ?>

</div>
    </div>

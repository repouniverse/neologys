<?php
 use kartik\date\DatePicker;
use yii\helpers\Html;
use common\helpers\h;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use frontend\modules\inter\Module as m;
use frontend\modules\inter\helpers\ComboHelper;
use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
use common\widgets\selectwidget\selectWidget;
/* @var $this yii\web\View */
/* @var $model common\models\masters\TrabajadoresSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trabajadores-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index-invitaciones'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
        <div class="form-group">
            <?= Html::submitButton("<span class='fa fa-search'></span>".m::t('verbs', 'Search'), ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
   
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      
                    <?php 
                        echo selectWidget::widget
                             (
                                [
                                    'model'=>$model,
                                    'form'=>$form,
                                    'campo'=>'docenteinv_id',
                                    'ordenCampo'=>4,
                                    'addCampos'=>[8,9],
                                ]
                            );                
                    ?>
                
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
    
    
    
   
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
    <?= ComboDep::widget([
               'model'=>$model,               
               'form'=>$form,
               'data'=> comboHelper::getCboUniversidades(),
               'campo'=>'universidad_id',
               'idcombodep'=>'interinvitacionessearch-facultad_id',
               
                   'source'=>[\common\models\masters\Facultades::className()=>
                                [
                                        'campoclave'=>'id' , //columna clave del modelo ; se almacena en el value del option del select 
                                        'camporef'=>'desfac',//columna a mostrar 
                                        'campofiltro'=>'universidad_id'  
                                ]
                                ],
                            ]
               
               
        )  ?>
 </div> 
  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> 
     
    <?php
   // $data=($model->isNewRecord)?[]:comboHelper::getCboFacultades($model->universidad_id);
   echo  $form->field($model, 'facultad_id')->
            dropDownList([],
                  ['prompt'=>'--'.m::t('verbs','Choose a value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    ) ?>
  
     </div> 
    
    
   
 
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <?= $form->field($model, 'numero') ?>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?= $form->field($model, 'descripcion') ?>
    </div>
   
    
    <?php ActiveForm::end(); ?>
</div>
 
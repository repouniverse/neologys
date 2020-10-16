<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
 use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
 use common\helpers\ComboHelper; 
/* @var $this yii\web\View */
/* @var $model common\models\masters\Tenores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tenores-form">
    <br>
    <?php $form = ActiveForm::begin([
    'fieldClass'=>'\common\components\MyActiveField'
    ]); ?>
      <div class="box-header">
        <div class="col-md-12">
            <div class="form-group no-margin">
                
        <?= Html::submitButton('<span class="fa fa-save"></span>   '.Yii::t('base_labels', 'Save'), ['class' => 'btn btn-success']) ?>
            

            </div>
        </div>
    </div>
      <div class="box-body">
    
     
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
    <?= ComboDep::widget([
               'model'=>$model,               
               'form'=>$form,
               'data'=> ComboHelper::getCboUniversidades(),
               'campo'=>'universidad_id',
               'idcombodep'=>'tenores-facultad_id',               
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
  
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">    
 <?= $form->field($model, 'facultad_id')->
            dropDownList(($model->isNewRecord)?[]:ComboHelper::getCboFacultades($model->universidad_id),
                  ['prompt'=>'--'.yii::t('base_verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    ) ?>
 </div> 
  
          
          
 
 
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <?= $form->field($model, 'idioma')->
            dropDownList(ComboHelper::getCboIdiomas(),
                  ['prompt'=>'--'.yii::t('base_verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    ) ?>
 </div>
           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <?= $form->field($model, 'posic')->
            dropDownList(['A'=>'A','B'=>'B','C'=>'C','D'=>'D','E'=>'E','F'=>'F',],
                  ['prompt'=>'--'.yii::t('base_verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    ) ?>
 </div>
 
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <?= $form->field($model, 'order')->
            dropDownList(ComboHelper::getCboCardinales(10),
                  ['prompt'=>'--'.yii::t('base_verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    ) ?>
 </div>
 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <?= $form->field($model, 'codocu')->
            dropDownList(ComboHelper::getCboDocuments(),
                  ['prompt'=>'--'.yii::t('base_verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    ) ?>
 </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
     <?= $form->field($model, 'activo')->checkBox([]) ?>

 </div>       
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <?= $form->field($model, 'texto')->textarea(['rows' => 6]) ?>

 </div>
  
     
    <?php ActiveForm::end(); ?>

</div>
    </div>

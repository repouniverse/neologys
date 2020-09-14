 <?php

use common\helpers\h;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper;
use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
use frontend\modules\inter\Module as m;
use common\widgets\selectwidget\selectWidget;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Combovalores */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="box box-success">
    <div class="box-body">
<div class="combovalores-form">

   <?php $form = ActiveForm::begin(['id'=>'form-pico',
        //'fieldClass'=>'\common\components\MyActiveField'
        ]); ?>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
        <div class="col-md-12">
            <div class="form-group no-margin">
       <?= \common\widgets\buttonsubmitwidget\buttonSubmitWidget::widget(
                  ['idModal'=>$idModal,
                    'idForm'=>'form-pico',
                      'url'=> ($model->isNewRecord)?\yii\helpers\Url::to(['/inter/programa/modal-new-eval','id'=>$model->programa_id]):
                     \yii\helpers\Url::to(['/inter/programa/modal-edit-eval','id'=>$model->id]),
                     'idGrilla'=>$gridName, 
                      ]
                  )?>
               <?=($model->isNewRecord)?'':common\widgets\auditwidget\auditWidget::widget(['model'=>$model])?>
        
                
            </div>
        </div>
        
        
        
        
        
        
    </div>
   
     
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
    <?= $form->field($model, 'acronimo')->textInput(['maxlength' => true]) ?>
  </div>
    <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
    
    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>
</div>
    
     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?=$form->field($model, 'carrera_id')->
            dropDownList(ComboHelper::getCboCarreras($model->facultad_id) ,
                    ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    )  ?>
        </div>   
     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
            <?= ComboDep::widget(
                [
                    'model'=>$model,               
                    'form'=>$form,
                    'data'=> ComboHelper::getCboDepartamentosFacu($model->facultad_id),
                    'campo'=>'depa_id',
                    'idcombodep'=>'interevaluadores-trabajador_id',
                    'source'=>
                    [   
                    \common\models\masters\Trabajadores::className()=>
                        [
                            'campoclave'=>'id' , //columna clave del modelo ; se almacena en el value del option del select 
                            'camporef'=>'ap',//columna a mostrar 
                            'campofiltro'=>'depa_id'  
                        ]
                    ],
                ])
            ?>
        </div>
    
    
     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?=$form->field($model, 'trabajador_id')->
            dropDownList(($model->isNewRecord)?[]:\common\helpers\ComboHelper::getcboTrabajadores($model->depa_id) ,
                    ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    )  ?>
        </div> 

    
    
    
    
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    
    <?= $form->field($model, 'detalles')->textArea([]) ?>
</div>   
   

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
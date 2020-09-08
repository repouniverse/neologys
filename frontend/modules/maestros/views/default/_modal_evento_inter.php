<?php
use common\helpers\h;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper;
use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
use frontend\modules\maestros\MaestrosModule as m;
use common\widgets\selectwidget\selectWidget;
    use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\masters\Combovalores */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="box-body">
  


   <?php $form = ActiveForm::begin(['id'=>'form-pico',
        'fieldClass'=>'\common\components\MyActiveField']); ?>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
        <div class="col-md-12">
            <div class="form-group no-margin">
       <?= \common\widgets\buttonsubmitwidget\buttonSubmitWidget::widget(
                  ['idModal'=>$idModal,
                    'idForm'=>'form-pico',
                      'url'=> ($model->isNewRecord)?\yii\helpers\Url::to(['/maestros/default/modal-new-evento-inter','id'=>$docente_id]):
                     \yii\helpers\Url::to(['/maestros/default/modal-edit-evento-inter','id'=>$model->id]),
                     'idGrilla'=>$gridName, 
                      ]
                  )?>
               <?=($model->isNewRecord)?'':common\widgets\auditwidget\auditWidget::widget(['model'=>$model])?>
        
                
            </div>
        </div>
        
        
        
        <br><br><br>
        
        
    </div>
   
     <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
             <?= $form->field($model, 'nombre')->textInput(['maxlength' => true,]) ?>
     </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
             <?= $form->field($model, 'web')->textInput(['maxlength' => true,]) ?>
     </div>
    
     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?php ?>
            <?= $form->field($model, 'finicio')->
                widget(DatePicker::class,
                [
                    'language' => h::app()->language,
                    'pluginOptions'=>
                    [
                        'format' => h::gsetting('timeUser', 'date'),
                        'changeMonth'=>true,
                        'changeYear'=>true,
                        'yearRange'=>'1980:'.date('Y'),
                    ],
                    'options'=>['class'=>'form-control']
                ])
            ?>
        </div>
    
    
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <?= $form->field($model, 'duracion')->textInput(['maxlength' => true]) ?>
  </div>
    
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
    
    <?= $form->field($model, 'ciudad')->textInput(['maxlength' => true]) ?>
    </div>
    
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">    
            <?= $form->field($model, 'pais')->
                       dropDownList(\frontend\modules\inter\helpers\ComboHelper::getCboPaises(),
                                   ['prompt'=>'--'.m::t('verbs','Choose a Value')."--",])
            ?>
        </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">    
            <?= $form->field($model, 'tipoexpo')->
                       dropDownList($model->comboDataField('tipoexpo'),
                                   ['prompt'=>'--'.m::t('verbs','Choose a Value')."--",])
            ?>
        </div>
    
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    
    <?= $form->field($model, 'detalle')->textArea([]) ?>
       </div>  
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    
    <?= $form->field($model, 'objetivosacad')->textArea([]) ?>
       </div>  
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    
    <?= $form->field($model, 'obetivosinter')->textArea([]) ?>
       </div>  
   

    <?php ActiveForm::end(); ?>

</div>
    
 

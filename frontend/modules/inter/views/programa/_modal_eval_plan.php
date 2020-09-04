<?php
use kartik\date\DatePicker;
use common\helpers\h;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\inter\helpers\ComboHelper;
use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
use backend\modules\base\Module as m;
use common\widgets\selectwidget\selectWidget;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Combovalores */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="box box-success">
    <div class="box-body">
<div class="combovalores-form">

   <?php $form = ActiveForm::begin(['id'=>'form-pico',
        'fieldClass'=>'\common\components\MyActiveField']); ?>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
        <div class="col-md-12">
            <div class="form-group no-margin">
       <?= \common\widgets\buttonsubmitwidget\buttonSubmitWidget::widget(
                  ['idModal'=>$idModal,
                    'idForm'=>'form-pico',
                      'url'=> ($model->isNewRecord)?\yii\helpers\Url::to(['/inter/programa/modal-new-plan','id'=>$model->modo_id]):
                     \yii\helpers\Url::to(['/inter/programa/modal-edit-plan','id'=>$model->id]),
                     'idGrilla'=>$gridName, 
                      ]
                  )?>
               <?=($model->isNewRecord)?'':common\widgets\auditwidget\auditWidget::widget(['model'=>$model])?>
        
                
            </div>
        </div>
        
        
        
        
        
        
    </div>
   
     
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'acronimo')->textInput(['maxlength' => true]) ?>
  </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    
    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>
</div>
    
     <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <?=$form->field($model, 'codocu')->
            dropDownList(ComboHelper::getCboDocuments() ,
                    ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    )  ?>
        </div> 
    
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <?=$form->field($model, 'etapa_id')->
            dropDownList(ComboHelper::getCboEtapas($model->modo_id),
                    ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    )  ?>
        </div>   
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <?=$form->field($model, 'eval_id')->
            dropDownList(ComboHelper::getCboEvaluadores($model->programa_id),
                    ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    )  ?>
        </div>  
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <?=$form->field($model, 'orden')->
            dropDownList(ComboHelper::getCboCardinales(40),
                    ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    )  ?>
        </div>   
    
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?php  //h::settings()->invalidateCache();  ?>
                       <?= $form->field($model, 'finicio')->widget(DatePicker::class, [
                             'language' => h::app()->language,
                           // 'readonly'=>true,
                          // 'inline'=>true,
                           'pluginOptions'=>[
                                     'format' => h::gsetting('timeUser', 'date')  , 
                                  'changeMonth'=>true,
                                  'changeYear'=>true,
                                 'yearRange'=>"-99:+0",
                               ],
                           
                            //'dateFormat' => h::getFormatShowDate(),
                            'options'=>['class'=>'form-control']
                            ]) ?>
</div>  
   

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
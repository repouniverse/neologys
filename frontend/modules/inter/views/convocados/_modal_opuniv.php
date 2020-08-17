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
        'fieldClass'=>'\common\components\MyActiveField']); ?>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
        
       <?= \common\widgets\buttonsubmitwidget\buttonSubmitWidget::widget(
                  ['idModal'=>$idModal,
                    'idForm'=>'form-pico',
                      'url'=> ($model->isNewRecord)?\yii\helpers\Url::to(['/inter/convocados/modal-new-opuniv','id'=>$model->convocatoria_id]):
                     \yii\helpers\Url::to(['/inter/convocados/modal-edit-opuniv','id'=>$model->id]),
                     'idGrilla'=>$gridName, 
                      ]
                  )?>
               <?=($model->isNewRecord)?'':common\widgets\auditwidget\auditWidget::widget(['model'=>$model])?>
        
     </div>       
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">    
    
    <?= $form->field($model, 'universidad_id')->label(m::t('labels','University'))->textInput(['value'=>$model->universidad->nombre,'disabled'=>true]) ?>
  </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">    
    <?= $form->field($model, 'facultad_id')->label(m::t('labels','Faculty'))->textInput(['value'=>$model->facultad->desfac,'disabled'=>true]) ?>

    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <?=$form->field($model, 'univop_id')->label(m::t('labels','Select Transfer University'))->
            dropDownList(ComboHelper::getCboUniversidades(),
                    ['prompt'=>'--'.m::t('verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    )  ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
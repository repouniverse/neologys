<?php
use common\helpers\h;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper;
use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
use backend\modules\base\Module as m;
/* @var $this yii\web\View */
/* @var $model common\models\masters\Combovalores */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="box box-success">
    <div class="box-body">
<div class="combovalores-form">

   <?php $form = ActiveForm::begin(['id'=>'form-asignar',
        'fieldClass'=>'\common\components\MyActiveField']); ?>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
        <div class="col-md-12">
            <div class="form-group no-margin">
       <?= \common\widgets\buttonsubmitwidget\buttonSubmitWidget::widget(
                  ['idModal'=>$idModal,
                    'idForm'=>'form-asignar',
                      'url'=> ($model->isNewRecord)?\yii\helpers\Url::to(['/repositorio/asesorcurso/modal-asesorcurso','id'=>$matricula_id]):
                     \yii\helpers\Url::to(['/repositorio/asesorcurso/modal-update-asesorcurso','id'=>$model->id]),
                     'idGrilla'=>$gridName, 
                      ]
                  )?>
                  
                
            </div>
        </div>
        
    </div>
    
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
         <?=$form->field($model, 'asesor_id')->
            dropDownList(ComboHelper::getCboAsesores($modelMatricula->curso_id,$modelMatricula->seccion),
                    ['prompt'=>'--'.yii::t('base_verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    )  ?>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>
</div>
</div>

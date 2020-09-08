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
                      'url'=> ($model->isNewRecord)?\yii\helpers\Url::to(['/maestros/default/modal-new-persona-idioma','id'=>$docente_id]):
                     \yii\helpers\Url::to(['/maestros/default/modal-edit-persona-idioma','id'=>$model->id]),
                     'idGrilla'=>$gridName, 
                      ]
                  )?>
               <?=($model->isNewRecord)?'':common\widgets\auditwidget\auditWidget::widget(['model'=>$model])?>
        
                
            </div>
        </div>
        
     <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
         <?=$form->field($model, 'idioma')->/*label(m::t('labels','Select Transfer University'))->*/
            dropDownList(ComboHelper::getCboIdiomas(),
                    ['prompt'=>'--'.m::t('verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    )  ?>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
         <?=$form->field($model, 'codnivel')->/*label(m::t('labels','Priority'))->*/
            dropDownList($model::comboDataField('codnivel'),
                    ['prompt'=>'--'.m::t('verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    )  ?>
    </div>
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <?=$form->field($model, 'detalle')->/*label(m::t('labels','Priority'))->*/
                   textarea([])  ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
</div>

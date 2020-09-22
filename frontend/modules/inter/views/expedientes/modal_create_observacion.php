<?php
use common\helpers\h;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper;
use yii\widgets\Pjax;
//use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
use frontend\modules\inter\Module as m;
//use common\widgets\selectwidget\selectWidget;
  /// use kartik\datetime\DateTimePicker;
//use common\widgets\buttonajaxwidget\buttonAjaxWidget;
/* @var $this yii\web\View */
/* @var $model common\models\masters\Combovalores */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="box box-success">
<?=    \common\widgets\spinnerWidget\spinnerWidget::widget();?>
    <div class="box-body">


   <?php
    $identidad=$persona->identidad;
   $form = ActiveForm::begin(['id'=>'form-pico',
        'fieldClass'=>'\common\components\MyActiveField']); ?>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php  //$url= Url::to(['create-horario','id'=>$model->id,'gridName'=>'grilla-rangos','idModal'=>'buscarvalor']);
             Pjax::begin(['id'=>'pjaxAsistencia','timeout'=>false]);
         ?>
        <div class="col-md-12">
            <div class="form-group no-margin">
            
       <?= \common\widgets\buttonsubmitwidget\buttonSubmitWidget::widget(
                  ['idModal'=>$idModal,
                    'idForm'=>'form-pico',
                      'url'=> ($model->isNewRecord)?\yii\helpers\Url::to(['/inter/expedientes/modal-new-obs','id'=>$expediente_id]):
                     \yii\helpers\Url::to(['/inter/expedientes/modal-edit-obs','id'=>$model->id]),
                     'idGrilla'=>$gridName, 
                      ]
                  )?>
               <?=($model->isNewRecord)?'':common\widgets\auditwidget\auditWidget::widget(['model'=>$model])?>
           <?php  //$url= Url::to(['create-horario','id'=>$model->id,'gridName'=>'grilla-rangos','idModal'=>'buscarvalor']);
              if(!$model->asistio)
              echo  Html::button(h::awe('check').h::space(10).m::t('labels','Confirm assistance'), ['href' => '#', 'title' => m::t('labels','Confirm assistance'),'id'=>'btn-asistencia', 'class' => 'btn-warning']); 
             
             ?>
                
            </div>
        </div>
        <?php  Pjax::end();  ?>
        
        <br><br>
        
        
        
    </div>
   
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($model, 'universidad_id')->textInput(['disabled'=>true,'value'=>$model->universidad->nombre,'maxlength' => true]) ?>
            <?= $form->field($model, 'convocado_id')->label(m::t('labels','Full Name'))->textInput(['disabled'=>true,'value'=>$model->convocado->alumno->persona->fullname(),'maxlength' => true]) ?>
        </div>
        
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <?= $form->field($model, 'facultad_id')->textInput(['disabled'=>true,'value'=>$model->facultad->desfac,'maxlength' => true]) ?>            
            <?= $form->field($model, 'modo_id')->textInput(['disabled'=>true,'value'=>$model->modo->descripcion,'maxlength' => true]) ?>            
        </div>
        
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <?= $form->field($model, 'expediente_id')->label(m::t('labels','File'))->textInput(['disabled'=>true,'value'=>$model->expediente->documento->desdocu,'maxlength' => true]) ?>            
            <?php //echo $form->field($model, 'etapa_id')->textInput(['disabled'=>true,'value'=>$model->etapa->descripcion,'maxlength' => true]) ?>            
        </div>        
                
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?= $form->field($model, 'detalles')->textarea([]) ?>            
        </div>
        
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
            <?= $form->field($model, 'valido')->checkBox() ?>           
        </div>
        
        
   

    <?php ActiveForm::end(); ?>

</div>
</div>


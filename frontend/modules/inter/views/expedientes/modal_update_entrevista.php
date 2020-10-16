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
   use kartik\datetime\DateTimePicker;
use common\widgets\buttonajaxwidget\buttonAjaxWidget;
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
                      'url'=> ($model->isNewRecord)?\yii\helpers\Url::to(['/expedientes/default/modal-new-entrevista','id'=>$facultad_id]):
                     \yii\helpers\Url::to(['/inter/expedientes/modal-edit-entrevista','id'=>$model->id]),
                     'idGrilla'=>$gridName, 
                      ]
                  )?>
               <?=($model->isNewRecord)?'':common\widgets\auditwidget\auditWidget::widget(['model'=>$model])?>
           <?php  //$url= Url::to(['create-horario','id'=>$model->id,'gridName'=>'grilla-rangos','idModal'=>'buscarvalor']);
              //if(!$model->asistio)
              //echo  Html::button(h::awe('check').h::space(10).m::t('labels','Confirm assistance'), ['href' => '#', 'title' => m::t('labels','Confirm assistance'),'id'=>'btn-asistencia', 'class' => 'btn-warning']); 
             
             ?>
                
            </div>
        </div>
        <?php  Pjax::end();  ?>
        
        <br><br>
        
        
        
    </div>
   
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($model, 'universidad_id')->textInput(['disabled'=>true,'value'=>$model->universidad->nombre,'maxlength' => true]) ?>
            <?= $form->field($model, 'convocado_id')->label(m::t('labels','Full Name'))->textInput(['disabled'=>true,'value'=>$model->convocado->postulante->persona->fullname(),'maxlength' => true]) ?>
        </div>
        
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <?= $form->field($model, 'facultad_id')->textInput(['disabled'=>true,'value'=>$model->facultad->desfac,'maxlength' => true]) ?>            
            <?= $form->field($model, 'modo_id')->textInput(['disabled'=>true,'value'=>$model->modo->descripcion,'maxlength' => true]) ?>            
        </div>
        
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <?= $form->field($model, 'convocado_id')->label(m::t('labels','Race'))->textInput(['disabled'=>true,'value'=>$model->convocado->postulante->carrera->nombre,'maxlength' => true]) ?>            
            <?= $form->field($model, 'etapa_id')->textInput(['disabled'=>true,'value'=>$model->etapa->descripcion,'maxlength' => true]) ?>            
        </div>
        
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <?php echo Html::img($identidad->image($identidad->code()),['width'=>140,'height'=>160, 'class'=>"img-thumbnail cuaizquierdo"]);?>
        </div>  
                
        
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">            
            <?php echo $form->field($model, 'fechaprog',['enableAjaxValidation'=>true])->widget(
        DateTimePicker::classname(), [
         'name' => 'fechaprog',
            'language' => h::app()->language,
            'options' => ['placeholder' =>m::t('verbs', 'Choose a value')],
    //'convertFormat' => true,
                'pluginOptions' => [
                'format' => h::getFormatShowDateTime(),
                //'startDate' => '01-Mar-2014 12:00 AM',
                'todayHighlight' => true
                                ]
                    ]); 
            ?>
        </div>
        
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
           <?php echo $form->field($model, 'finicio',['enableAjaxValidation'=>true])->widget(
        DateTimePicker::classname(), [
         'name' => 'finicio',
            'language' => h::app()->language,
            'options' => ['placeholder' =>m::t('verbs', 'Choose a value')],
    //'convertFormat' => true,
                'pluginOptions' => [
                'format' => h::getFormatShowDateTime(),
                //'startDate' => '01-Mar-2014 12:00 AM',
                'todayHighlight' => true
                                ]
                    ]); 
            ?>          
        </div>
        
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <?php echo $form->field($model, 'ftermino',['enableAjaxValidation'=>true])->widget(
        DateTimePicker::classname(), [
         'name' => 'ftermino',
            'language' => h::app()->language,
            'options' => ['placeholder' =>m::t('verbs', 'Choose a value')],
    //'convertFormat' => true,
                'pluginOptions' => [
                'format' => h::getFormatShowDateTime(),
                //'startDate' => '01-Mar-2014 12:00 AM',
                'todayHighlight' => true
                                ]
                    ]); 
            ?>
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?= $form->field($model, 'detalles')->textarea([
                'maxlength' => true,
                'rows' => 10,
                ]) ?>            
        </div>
        
        <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
            <?= $form->field($model, 'detalles_secre')->textarea([
                'maxlength' => true,
                 'rows' => 10,
                ]) ?>            
        </div>
        
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
            <?= $form->field($model, 'asistio')->checkBox() ?>           
        </div>
        
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">            
            <?= $form->field($model, 'activo')->checkBox(['disabled'=>true]) ?>
        </div>
   

    <?php ActiveForm::end(); ?>
<?php
 echo buttonAjaxWidget::widget([
                        'id'=>'btn-asistencia',
                        'idGrilla'=>'pjaxAsistencia',
                        'ruta'=>Url::to(['/inter/expedientes/ajax-asiste-entrevista','id'=>$model->id]),
                   
 ]);
?>

</div>
</div>


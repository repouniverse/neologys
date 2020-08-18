<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\inter\Module as m;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\editable\Editable;
/* @var $this yii\web\View */
/* @var $model frontend\modules\inter\models\InterConvocados */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inter-convocados-view-alumno">
    <br>
    <?php $form = ActiveForm::begin([
    'fieldClass'=>'\common\components\MyActiveField'
    ]); ?>
      <div class="box-header">
        <div class="col-md-12">
            <div class="form-group no-margin">
       
            </div>
        </div>
    </div>
      <div class="box-body">
 
  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
     <?= $form->field($model, 'codalu')->label(m::t('labels','Code Student'))->textInput(['disabled'=>true]) ?>
      
 </div>
  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
           
 </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
     <?= $form->field($model, 'id')->label(m::t('labels','Student'))->textInput(['value'=>$model->fullName(false),'disabled'=>true]) ?>
           
 </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
     <?= $form->field($model, 'facultad_id')->label(m::t('labels','Faculty'))->textInput(['value'=>$model->facultad->desfac,'disabled'=>true]) ?>
      
 </div>
 
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
     <?= $form->field($model, 'carrera_id')->label(m::t('labels','Race'))->textInput(['value'=>$model->carrera->nombre,'disabled'=>true]) ?>
      
 </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <?php
            echo Editable::widget([
          'model'=>$model,
          'attribute'=>'mail',
          'asPopover' => false,
          //'value' => 'Kartik Visweswaran',
          'header' => 'Name',
          'size'=>'md',
          'options' => ['class'=>'form-control', 'placeholder'=>'Enter person name...']
      ]);
      ?> 
     <?= $form->field($model, 'mail')->label(m::t('labels','Mail'))->textInput(['disabled'=>false]) ?>
      
 </div>
          
          
          
   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <p>
         <?php $url= Url::to(['modal-new-opuniv','id'=>$model->id,'gridName'=>'OpcionesUniversidad','idModal'=>'buscarvalor']);
        //echo  Html::button(yii::t('base.verbs','Modificar Rangos'), ['href' => $url, 'title' => yii::t('sta.labels','Agregar Tutor'),'id'=>'btn_contacts', 'class' => 'botonAbre btn btn-success']); 
       echo Html::a('<span class="btn btn-success btn-sm glyphicon glyphicon-plus"></span>', $url, ['class'=>'botonAbre']);
         ?>           
     </p>
      
 
    </div>
          </div>
              </div>


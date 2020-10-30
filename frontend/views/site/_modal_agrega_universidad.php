<?php
//use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
 //use kartik\date\DatePicker;

use common\helpers\h;
use frontend\modules\inter\helpers\comboHelper;
//use common\widgets\selectwidget\selectWidget;
/* @var $this yii\web\View */
/* @var $model frontend\modules\sigi\models\SigiUnidades */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sigi-unidades-form">

    <?php $form = ActiveForm::begin([
        'id'=>'myformulario'/*,'enableAjaxValidation'=>true*/
    ]); ?>
      <div class="box-header">
          
        <div class="col-md-12">
            <div class="form-group no-margin">
          <?= \common\widgets\buttonsubmitwidget\buttonSubmitWidget::widget(
                  ['idModal'=>$idModal,
                    'idForm'=>'myformulario',
                      'url'=> \yii\helpers\Url::toRoute(['/'.$this->context->id.'/'.(($model->isNewRecord)?'agrega':'edita').'-universidad','id'=>$id]),
                     'idGrilla'=>$gridName, 
                      ]
                  )?>
         
                  

            </div>
        </div>
    </div>
     
  
      <div class="box-body">
 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
    <?php 
       echo $form->field($model, 'universidad_id')->
            dropDownList(comboHelper::getCboUniversidades(),
                  ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                     ]
                    );
        ?>
 </div> 
 
     
    <?php ActiveForm::end(); ?>

</div>
    </div>

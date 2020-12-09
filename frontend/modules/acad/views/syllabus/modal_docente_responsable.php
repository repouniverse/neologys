<?php
//use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
 //use kartik\date\DatePicker;

use common\helpers\h;
//use frontend\modules\sigi\helpers\comboHelper;
use common\widgets\selectwidget\selectWidget;
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
                      'url'=> ($model->isNewRecord)?Url::to(['/acad/'.$this->context->id.'/modal-crea-docente','id'=>$id]):Url::to(['/acad/'.$this->context->id.'/modal-edita-docente','id'=>$id]),
                     'idGrilla'=>$gridName, 
                      ]
                  )?>
         
                  

            </div>
        </div>
    </div>
     
  
      <div class="box-body">
 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
     <?php 
  // $necesi=new Parametros;
    echo selectWidget::widget([
           // 'id'=>'mipapa',
            'model'=>$model,
            'form'=>$form,
            'campo'=>'docente_id',
         'ordenCampo'=>2,
         'addCampos'=>[4,8,9,10,11],
        ]);  ?>

 </div> 
     
    <?php ActiveForm::end(); ?>

</div>
    </div>


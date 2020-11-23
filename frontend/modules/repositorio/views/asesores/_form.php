<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\widgets\selectwidget\selectWidget;
/* @var $this yii\web\View */
/* @var $model common\models\masters\Asesores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asesores-form">
	<div class="box-body">	

    <?php $form = ActiveForm::begin(); ?>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
     <?php 
  // $necesi=new Parametros;
    echo selectWidget::widget([
           // 'id'=>'mipapa',
            'model'=>$model,
            'form'=>$form,
            'campo'=>'persona_id',
         'ordenCampo'=>1,
         'addCampos'=>[5,6,7,8],
        ]);  ?>

 </div>

 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
    <?= $form->field($model, 'orcid')->textInput(['maxlength' => true]) ?>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">	
    <?= $form->field($model, 'activo')->checkBox() ?>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">	
    <div class="form-group">
        <?= Html::submitButton(Yii::t('base_verbs', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>
</div>
</div>

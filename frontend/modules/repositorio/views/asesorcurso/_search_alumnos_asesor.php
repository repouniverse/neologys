<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper;

/* @var $this yii\web\View */
/* @var $model common\models\masters\AsesoresCursoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asesores-curso-search">

    <?php $form = ActiveForm::begin([
       // 'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
     <?= $form->field($model, 'apasesor') ?>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
    <?= $form->field($model, 'descripcion') ?>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> 
    <?= $form->field($model, 'carrera_id')->dropDownList
                         (
                          ComboHelper::getCboCarreras(1), ['prompt'=>'--'.yii::t('base_verbs','Choose a value')."--",]
                         ) ?>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> 
    <?= $form->field($model, 'codalu') ?>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> 
    <?= $form->field($model, 'periodo') ?>
  </div>

   

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

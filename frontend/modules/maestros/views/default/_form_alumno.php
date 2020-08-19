<?php
//use kartik\typeahead\Typeahead;
use yii\helpers\Url;
use common\helpers\h;
use common\models\masters\Personas;
use common\helpers\ComboHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use frontend\modules\maestros\MaestrosModule as m;
use common\models\masters\Facultades;
/* @var $this yii\web\View */
/* @var $model common\models\masters\Trabajadores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-success">
    <?php $form = ActiveForm::begin([
          'id' => 'alumnos-form',
          'enableAjaxValidation' => true,
          'fieldClass' => 'common\components\MyActiveField',
          //'options'=>['enctype' => 'multipart/form-data'],'fieldClass' => '\common\components\MyActiveField'
          ]); 
    ?>
        
    <div class="box-header">
        <div class="col-md-12">
            <div class="form-group no-margin">
                <?= Html::submitButton(m::t('verbs', 'Save'), ['class' => 'btn btn-success']) ?>
                <?=($model->isNewRecord)?'':common\widgets\auditwidget\auditWidget::widget(['model'=>$model])?>       
            </div>
        </div>
    </div>
    
    <div class="box-body">
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($model, 'codalu')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">    
            <?= $form->field($model, 'ap')->textInput() ?>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($model, 'am')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <?=$form->field($model, 'codfac')->
                      dropDownList(ComboHelper::getCboFacultades(), ['prompt'=>'--'.m::t('verbs','Choose a Value')."--",])
                      //dropDownList(Facultades::comboDataField('codfac') , ['prompt'=>'--'.m::t('verbs','Choose a Value')."--",])
            ?>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <?=$form->field($model, 'tipodoc')->
                      dropDownList(Personas::comboDataField('tipodoc'),['prompt'=>'--'.m::t('verbs','Choose a Value')."--",])
            ?>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($model, 'numerodoc')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

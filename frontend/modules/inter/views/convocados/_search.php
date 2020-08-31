<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\inter\helpers\comboHelper;
use frontend\modules\inter\Module as m;
?>

<div class="citas-search">
    <?php $form = ActiveForm::begin(
          [
            'action' => ['index','id'=>$id, 'modelPrograma'=>$modelPrograma],
            'method' => 'get',
            'options' => ['data-pjax' => 1],
          ]); 
    ?>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
        <div class="form-group">
            <?= Html::submitButton("<span class='fa fa-search'></span>".m::t('verbs', 'Search'), ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
  
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?= 
            $form->field($model, 'codperiodo')->
                         dropDownList
                         (
                            comboHelper::getCboPeriodos(), ['prompt'=>'--'.m::t('verbs','Choose a value')."--",]
                         )
        ?>
    </div>
 
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?= 
            $form->field($model, 'modo_id')->
                         dropDownList
                         (
                            comboHelper::getCboModos(), ['prompt'=>'--'.m::t('verbs','Choose a value')."--",]
                         )
        ?>
    </div>
    
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?= 
            $form->field($model, 'facultad_id')->
                         dropDownList
                         (
                            comboHelper::getCboFacultades(), ['prompt'=>'--'.m::t('base.verbs','Choose a value')."--",]
                         )
        ?>
    </div>
     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?= 
            $form->field($model, 'current_etapa')->
                         dropDownList
                         (
                            comboHelper::getCboStages(1), ['prompt'=>'--'.m::t('base.verbs','Choose a value')."--",]
                         )
        ?>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?= $form->field($model, 'am') ?>
    </div> 
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?= $form->field($model, 'nombres') ?>
    </div> 
    
    <?php ActiveForm::end(); ?>
</div>

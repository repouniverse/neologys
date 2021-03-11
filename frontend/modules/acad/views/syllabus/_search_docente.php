<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\maestros\MaestrosModule as m;
use common\models\masters\Personas;
use common\helpers\ComboHelper as combo;
?> 

<div class="docentes-search">
    <?php $form = ActiveForm::begin(
                  [
                   'action' => ['index-docentes'],
                   'method' => 'get',
                   'options' => ['data-pjax' => 1],
                  ]); 
    ?>
    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
        <div class="form-group">
            <?= Html::submitButton("<span class='fa fa-search'></span>".yii::t('base_verbs', 'Search'), ['class' => 'btn btn-primary']) ?>
                        <?php $url=Url::to(['/maestros/default/index-docentes']); ?>
                 <?= Html::a(yii::t('base_verbs', 'Create Teacher'), $url, ['class' => 'btn btn-success']) ?>
              
          
    </div>
    
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
        <?= 
            $form->field($model, 'universidad_id')->
                   dropDownList
                   (
                        combo::getCboUniversidades(),['prompt'=>'--'.yii::t('base_verbs','Choose a Value')."--",]
                   )
        ?>
    </div>
    
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <?= 
            $form->field($model, 'tipodoc')->
                   dropDownList
                   (
                        Personas::comboDataField('tipodoc'),['prompt'=>'--'.yii::t('base_verbs','Choose a Value')."--",]
                   )
        ?>
    </div>
    
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <?= $form->field($model, 'numerodoc') ?>        
    </div>
    
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <?= $form->field($model, 'codoce') ?>        
    </div>  
        
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <?= $form->field($model, 'ap') ?>
    </div>
    
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <?= $form->field($model, 'am') ?>
    </div>
    
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <?= $form->field($model, 'nombres') ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php
use common\helpers\h;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper;


/* @var $this yii\web\View */
/* @var $model common\models\masters\Combovalores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="combovalores-form">

    <?php $form = ActiveForm::begin([
        'id'=>'miorme',
        'enableAjaxValidation'=>true
    ]); ?>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
        <?= Html::submitButton('<span class="fa fa-save"></span>    '.yii::t('base.verbs', 'Save'), ['class' => 'btn btn-success']) ?>
         <?=($model->isNewRecord)?'':common\widgets\auditwidget\auditWidget::widget(['model'=>$model])?>
        </div>
    </div>
    <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'codgrupo')->textInput(['maxlength' => true]) ?>

    </div>
    
     <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'desgrupo')->textInput(['maxlength' => true]) ?>

    </div>
    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
       <?= $form->field($model, 'modelo')->
            dropDownList(ComboHelper::getCboModels(),
                    ['prompt'=>'--'.yii::t('base.verbs','Choose a value')."--",
                    // 'class'=>'probandoSelect2',
                        ]
                    ) ?>
    
       
    </div>
    
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
       <?= $form->field($model, 'layout')->
            dropDownList($model->mapFiles(),
                    ['prompt'=>'--'.yii::t('base.verbs','Choose a value')."--",
                    // 'class'=>'probandoSelect2',
                        ]
                    ) ?>
    
       
    </div>
    
   

    <?php ActiveForm::end(); ?>

</div>

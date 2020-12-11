<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\maestros\MaestrosModule as m;
use common\helpers\ComboHelper;
/* @var $this yii\web\View */
/* @var $model common\models\Documentos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="documentos-form">
  <div class="body">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codocu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desdocu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'clase')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo')->textInput(['maxlength' => true]) ?>

   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
       <?= $form->field($model, 'tabla')->
            dropDownList(ComboHelper::getCboModels(),
                    ['prompt'=>'--'.yii::t('base_verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                        ]
                    ) ?>
    
       
    </div>
    <?= $form->field($model, 'abreviatura')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prefijo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'escomprobante')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idreportedefault')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(m::t('verbs', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
</div>

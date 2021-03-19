<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\modules\encuesta\models\EncuestaTipoEncuesta */
/* @var $form yii\widgets\ActiveForm */
?>
<!-- <?= Html::submitButton("<span class='fa fa-search'></span>".yii::t('base_verbs', 'Search'), ['class' => 'btn btn-primary']) ?>
<?php $url=Url::to(['/maestros/default/index-docentes']); ?>
                 <?= Html::a(yii::t('base_verbs', 'Create Teacher'), $url, ['class' => 'btn btn-success']) ?> -->

<div class="encuesta-tipo-encuesta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre_tipo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Siguiente'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <!-- $url = Url::to() -->
</div>

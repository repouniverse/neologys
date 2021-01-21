<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\buzon\models\BuzonMensajes */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="panel-heading">
    <h5>
        <b>CATEGORIA</b>
    </h5>
</div>
<div class="categorias-body">

</div>
<div class="panel-heading" style="margin-top: 0;">
    <h5>
        <b>MOTIVO</b>
    </h5>
</div>
<div class="categorias-body">
    <p>Estimado alumno, este espacio ha sido diseñado para usted. Por favor, ingrese su consulta, duda o queja</p>
</div>
<div class="panel-heading" style="margin-top: 0;">
    <h5>
        <b>DATOS PERSONALES</b>
    </h5>
    
</div>
<div class="categorias-body">
<p>(<span class="color-rojo">*</span>) Estos campos son obligatorios</p>
</div>

<div class="buzon-mensajes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'departamento_id')->textInput() ?>

    <?= $form->field($model, 'mensaje')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'estado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prioridad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_registro')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<style>
.panel-heading{
    color: #333;
    background-color: #f5f5f5;
    
    padding: 10px 15px;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
    margin-top: -20px;
}

.categorias-body{
    padding: 15px;
    width: 100%;
    height: 250px;
    border-left: 1px solid #D0D3D4;
    border-right: 1px solid #D0D3D4;
    border-bottom: 1px solid #D0D3D4;
    border-top: none;
}

.color-rojo{
    color: red
}



</style>
<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper as combo;
use yii\widgets\Pjax;
use common\helpers\h;




/* @var $this yii\web\View */
/* @var $model frontend\modules\buzon\models\BuzonMensajes */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="contenedor-form">
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
</div>


<div class="buzon-mensajes-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="panel-heading">
        <h5>
            <b>CATEGORIA</b>
        </h5>
    </div>
    <?= $form->field($model, 'departamento_id')->dropDownList(
        combo::getCboDepartamentosFacu(1),
        ['prompt' =>  yii::t('base_verbs', 'Choose a Value'),]
    ) ?>
    <div class="panel-heading" style="margin-top: 0;">
        <h5>
            <b>MOTIVO</b>
        </h5>
    </div>
    <div class="motivos-body">
        <p class="text-primary">Estimado alumno, este espacio ha sido diseñado para usted. Por favor, ingrese su consulta</p>
        <?= $form->field($model, 'mensaje')->textarea(['rows' => 10]) ?>
    </div>
    <!-- <div class="panel-heading" style="margin-top: 0;">
        <h5>
            <b>DATOS PERSONALES</b>
        </h5>

    </div> -->
    <!-- /DATOS DEL PERSONAL -->
    <div class="personal-body">

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
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

.contenedor-form{
    width: 60%;
    margin-left: 20% ;
}

</style>
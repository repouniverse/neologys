<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper as combo;
use Mpdf\Tag\Span;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\modules\encuesta\models\EncuestaEncuestaGeneral */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="encuesta-encuesta-general-form">



    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'titulo_encuesta')->textInput(['maxlength' => true,'placeholder' =>"Ingrese el Titulo de la encuesta"]) ?>

    <?= $form->field($model, 'id_tipo_usuario')->dropDownList(
        combo::getCboGrupoPersonas(),
        ['prompt' => '--' . yii::t('base_verbs', 'Choose a value') . "--",]
    ) ?>
  
    <?php $url=Url::to(['/encuesta/tipo-encuesta/create']); ?>
    
    <?= $form->field($model, 'id_tipo_encuesta')->dropDownList(
        combo::getTipoEncuesta(),
        ['prompt' => '--' . yii::t('base_verbs', 'Choose a value') . "--",]
    ) 
    ?>


    

 


    <?= $form->field($model, 'descripcion')->textarea(['rows' => 5, 'placeholder' =>'Ingrese la descripción de la encuesta']) ?>
    

    <?= $form->field($model, 'numero_preguntas')->textInput(['maxlength' => true, 'placeholder' =>"Ingrese el numero de preguntas"]) ?>

    <?= $form->field($model, 'id_dep_encargado')->dropDownList(
        combo::getDepartamentos(),
        ['prompt' => '--' . yii::t('base_verbs', 'Choose a value') . "--",]
    ) ?>

<div class="form-group">
        
        <?= Html::submitButton(Yii::t('app', 'Siguiente'), ['class' => 'btn btn-success']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>

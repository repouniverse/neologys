<?php

use yii\base\DynamicModel;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use common\models\masters\Departamentos;
use frontend\modules\encuesta\models\EncuestaTipoEncuesta;
use frontend\modules\encuesta\models\EncuestaTipoPregunta;
use frontend\modules\encuesta\models\EncuestaOpcionesPregunta;
use common\helpers\h;

$opcs = ['5' => '5', '4' => '4', '3' => '3', '2' => '2', '1' => '1'];
?>
<?php $form = ActiveForm::begin(); ?>

<div class="encuesta-pregunta-formulario">
    <div class="grid">
        <div class="grit-item1">
            <p>Item</p>
        </div>
        <div class="grit-item1">
            <p>Nunca me paso</p>
        </div>
        <div class="grit-item1">
            <p>Algunas veces me pasa</p>
        </div>
        <div class="grit-item1">
            <p>A veces si, a veces no</p>
        </div>
        <div class="grit-item1">
            <p>Frecuentemente me pasa</p>
        </div>
        <div class="grit-item1">
            <p>Siempre me pasa</p>
        </div>

        <?php
        $numPregunta = 1;
        foreach ($listaPreguntas as $pregunta) {
        ?>

            <div class="grit-items"><?= ' ' . $numPregunta . '. ' . $pregunta->pregunta ?></div>
            <div class="grit-items-respuesta">
                <?= $form->field($model, 'respuestas[' . $pregunta->id . ']')->radio(['label' => '5', 'value' => '5', 'uncheck' => null, 'class' => "checkradio-pregunta"]) ?>
            </div>
            <div class="grit-items-respuesta">
                <?= $form->field($model, 'respuestas[' . $pregunta->id . ']')->radio(['label' => '4', 'value' => '4', 'uncheck' => null, 'class' => "checkradio-pregunta"]) ?>
            </div>
            <div class="grit-items-respuesta">
                <?= $form->field($model, 'respuestas[' . $pregunta->id . ']')->radio(['label' => '3', 'value' => '3', 'uncheck' => null, 'class' => "checkradio-pregunta"]) ?>
            </div>
            <div class="grit-items-respuesta">
                <?= $form->field($model, 'respuestas[' . $pregunta->id . ']')->radio(['label' => '2', 'value' => '2', 'uncheck' => null, 'class' => "checkradio-pregunta"]) ?>
            </div>
            <div class="grit-items-respuesta">
                <?= $form->field($model, 'respuestas[' . $pregunta->id . ']')->radio(['label' => '1', 'value' => '1', 'uncheck' => null, 'class' => "checkradio-pregunta"]) ?>
            </div>


        <?php
            $numPregunta = $numPregunta + 1;
        }
        ?>

    </div>
</div>


<?php if (!$is_encuestador) { ?>
    <div class="form-group  boton-submit-content">
        <?= Html::submitButton(Yii::t('base_verbs', 'Send'), ['class' => 'btn-send-respuestas']) ?>
    </div>
<?php }else{ ?>
    <div class="encuesta-prediseño">
        <strong>VISUALIZACIÓN PREDETERMINADA  </strong>
    </div>
<?php }?>


<?php ActiveForm::end(); ?>

<style>
    .checkradio-pregunta:after {
        width: 16px;
        height: 16px;
        border-radius: 15px;
        top: -2px;
        left: -3px;
        position: relative;
        background-color: white;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 1px solid black;
    }

    .checkradio-pregunta:checked:after {
        width: 18px;
        height: 18px;
        border-radius: 15px;
        top: -2px;
        left: -3px;
        position: relative;
        background-color: #910128;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 1px solid white;
    }

    .encuesta-pregunta-formulario {
        background-color: white;
        border-radius: 8px;
        border: 0.5px solid #BCBABA;
        padding: 20px;
        margin: 15px 0px 15px 0px;
    }

    .cuadricula-casilla {
        border: 0.5px solid #BCBABA;

    }

    .grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-gap: 0px;
        grid-template-columns: 35% 13% 13% 13% 13% 13%;
        color: black;

    }

    .grit-item1 {
        background-color: #DFB3BF;
        text-align: center;

        border: 0.5px solid #910128;
        padding: 5px;
        font-family: Roboto, Arial, sans-serif;
        font-size: 15px;
        font-weight: 600;

    }

    .grit-items {
        text-align: left;
        border: 0.5px solid #910128;
        padding: 10px;
        font-family: Roboto, Arial, sans-serif;
        font-size: 15px;
        font-weight: 400;
    }

    .grit-items:hover {
        background-color: #FBEDF0;
    }

    .grit-items-respuesta {
        text-align: center;
        border: 0.5px solid #910128;
        padding: 10px;
    }

    .grit-items-respuesta:hover {
        background-color: #FBEDF0;
    }

    .opc-combo {
        color: black;
        font-size: 15px;
        border-radius: 8px;
        height: 30px;
    }

    .btn-send-respuestas {
        border-radius: 5px;
        height: 40px;
        width: 100px;
        background-color: #910128;
        font-family: 'Google Sans', Roboto, Arial, sans-serif;
        font-size: 14px;
        font-weight: 500;
        color: white;
        border: none;
    }

    .btn-send-respuestas:hover {
        background-color: #9C2646;
    }
    .encuesta-prediseño{
        color: black;
        border-radius: 8px;
        border: 2px dashed black;
        padding: 10px;
        margin: 15px 0px 15px 0px;
    }
</style>
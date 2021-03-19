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

$opcs = ['SI' => 'SI', 'NO' => 'NO']
?>
<?php $form = ActiveForm::begin(); ?>

<div class="encuesta-pregunta-formulario">
    <div class="grid">
        <div class="grit-item1">
            <p>Item</p>
        </div>
        <div class="grit-item1">
            <p>Respuesta</p>
        </div>


        <?php
        $numPregunta = 1;
        foreach ($listaPreguntas as $pregunta) {
        ?>
            <div class="grit-items"><?= ' ' . $numPregunta . '. ' . $pregunta->pregunta ?></div>
            <div class="grit-items-respuesta"><?=
                                                $form->field($model, 'respuestas[' . $pregunta->id . ']')->dropDownList(
                                                    $opcs,
                                                    [
                                                        'prompt' => '--' . yii::t('base_verbs', 'Valor') . "--",
                                                        'class' => 'opc-combo'
                                                    ]
                                                )->label(false)
                                                ?></div>
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
<?php } ?>
<?php ActiveForm::end(); ?>

<style>
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
        grid-template-columns: 80% 20%;
        color: black;
    }

    .grit-item1 {
        background-color: #DFB3BF;
        text-align: center;
        height: 30px;
        border: 0.5px solid #910128;
        padding: 5px;
        font-family: Roboto, Arial, sans-serif;
        font-size: 18px;
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
</style>
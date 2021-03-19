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

?>
<?php $form = ActiveForm::begin(); ?>
<?php
if (!is_null($listaPreguntas)) {
    $num_pregunta = 1;
    foreach ($listaPreguntas as $pregunta) {
        $num_opcion = 1;
        echo '<div class="encuesta-pregunta-formulario" >';
        echo '<p style="font-size: 16px;">' . $num_pregunta . '. ' . $pregunta->pregunta . '</p>';

        echo '<div class="opciones-form">';
        if (h::getTipoPreguntaEncuesta($pregunta->id_tipo_pregunta) == 'MULTIPLE') {
            //models[$key]->attributes

            $opciones = EncuestaOpcionesPregunta::findAll(['id_pregunta' => $pregunta->id]);
?>
            <?= $form->field($model, 'respuestas[' . $pregunta->id . ']')->radioList(
                ArrayHelper::map($opciones, 'descripcion', 'descripcion'),
                [
                    'item' => function ($index, $label, $name, $checked, $value) {

                        $return = '<label class="opciones-pregunta">';
                        $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" tabindex="3" class="checkradio-pregunta">  ';
                        $return .= '<span>' . ucwords($label) . '</span>';
                        $return .= '</label><br>';

                        return $return;
                    }
                ]
            )->label(false)
            ?>
        <?php
            //echo Html::activeRadioList($model,'respuestas['.$pregunta->id.']', ArrayHelper::map($opciones, 'id', 'descripcion'), ['separator' => '<br>', 'id'=>  $pregunta->id ]);
            //echo Html::radioList($pregunta->id, null, ArrayHelper::map($opciones, 'id', 'descripcion'), ['separator' => '<br>']);
            if (sizeof($opciones) <= 0)
                echo "<strong>Esta pregunta se encuentra en desarrollo.</strong>";
        } else if (h::getTipoPreguntaEncuesta($pregunta->id_tipo_pregunta) == 'LIBRE') {
        ?>
            <?= $form->field($model, 'respuestas[' . $pregunta->id . ']')->textInput(['class' => 'input-respuesta']) ?>
<?php
        } else {
            echo "PON BIEN EL TIPO DE PREGUNTA EN TU BD";
        }
        echo '</div>';
        echo '</div>';
        $num_pregunta = $num_pregunta + 1;
    }
}
?>
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

    .opciones-form {
        padding: 10px;
    }

    .opciones-pregunta {
        font-family: Roboto, Arial, sans-serif;
        font-size: 14px;
        font-weight: 400;
        letter-spacing: .2px;
        line-height: 20px;
        color: #202124;
        min-width: 1px;
    }

    .input-respuesta {
        font-family: Roboto, Arial, sans-serif;
        width: 100%;
        font-size: 17px;
        font-weight: 400;
        letter-spacing: .2px;
        line-height: 20px;
        color: #202124;
        border: none;
        border-bottom: 1px solid #202124;
    }

    .input-respuesta:hover {
        border: none;
        border-bottom: 1px solid #910128;
    }

    .input-respuesta:focus {
        outline: none;
        border: none;
        border-bottom: 1px solid #910128;
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
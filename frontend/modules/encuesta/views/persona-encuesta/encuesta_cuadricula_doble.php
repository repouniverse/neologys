<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use common\models\masters\Departamentos;
use frontend\modules\encuesta\models\EncuestaTipoEncuesta;
use frontend\modules\encuesta\models\EncuestaTipoPregunta;
use frontend\modules\encuesta\models\EncuestaOpcionesPregunta;
use common\helpers\h;

?>

<?php
if (!is_null($listaPreguntas)) {
    $num_pregunta = 1;
    foreach ($listaPreguntas as $pregunta) {
        $num_opcion = 1;
        echo '<div class="encuesta-pregunta-formulario" >';
        echo '<p style="font-size: 16px;">' . $num_pregunta . '. ' . $pregunta->pregunta . '</p>';

        echo '<div class="opciones-form">';
        if (h::getTipoPreguntaEncuesta($pregunta->id_tipo_pregunta) == 'MULTIPLE') {
            $opciones = EncuestaOpcionesPregunta::findAll(['id_pregunta' => $pregunta->id]);
            echo Html::radioList($pregunta->id, null, ArrayHelper::map($opciones, 'id', 'descripcion'), ['separator' => '<br>']);
            if (sizeof($opciones) <= 0)
                echo "<strong>Esta pregunta se encuentra en desarrollo.</strong>";
        } else if (h::getTipoPreguntaEncuesta($pregunta->id_tipo_pregunta) == 'LIBRE') {
            echo Html::textInput('aer',null,[]);
        } else {
            echo "PON BIEN EL TIPO DE PREGUNTA EN TU BD";
        }
        echo '</div>';
        echo '</div>';
        $num_pregunta = $num_pregunta + 1;
    }
}
?>

<style>
    .encuesta-pregunta-formulario {
        background-color: white;
        border-radius: 15px;
        border: 0.5px solid #BCBABA;
        padding: 20px;
        margin: 15px 0px 15px 0px;
    }

    .opciones-form {
        padding: 10px;
    }
    
</style>
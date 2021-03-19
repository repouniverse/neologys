<?php

use yii\base\DynamicModel;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use common\models\masters\Departamentos;
use frontend\modules\encuesta\models\EncuestaTipoEncuesta;
use common\helpers\h;

$this->title = Yii::t('app',  $encuesta->titulo_encuesta);


?>



<div class="encuesta-encuesta-preguntas">
    <div>
        <div class="encuesta-titulo-franja">

        </div>
        <div class="encuesta-titulo-preguntas">

            <h1><?= Html::encode($this->title) ?></h1>
            <p><?= Html::encode("Encuesta realizada por el Dpto. de " . h::getNombreDepartamentoById($encuesta->id_dep_encargado)) ?></p>
            <p><?= Html::encode($encuesta->descripcion) ?></p>

        </div>


    </div>

    <div class=" encuesta-subtitulo-preguntas">
        <h4><?= Html::encode('INSTRUCCIONES') ?></h4>
        <span><?= Html::encode("Lea atentamente las preguntas y responda.") ?></span>
    </div>

    <div>
        <?php

        echo $this->render(
            h::getTipoEncuesta(EncuestaTipoEncuesta::findOne(['id' => $encuesta->id_tipo_encuesta])->nombre_tipo),
            ['id_encuesta' => $encuesta->id, 'listaPreguntas' => $listaPreguntas,  'model' => $model, 'is_encuestador' =>  $is_encuestador]
        );
        ?>

    </div>



</div>

<style>
    .encuesta-encuesta-preguntas {
        background-color: #EBDCE1;
        padding: 20px 40px 20px 40px;
    }


    .encuesta-titulo-franja {
        height: 10px;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
        height: 10px;
        left: -1px;
        top: -1px;
        width: calc(100%);
        background-color: #910128;
    }

    .encuesta-titulo-preguntas {
        padding: 24px;
        padding-top: 10px;
        background-color: #FFFFFF;
        border-radius: 0px 0px 8px 8px;
        border: 0.5px solid #BCBABA;
    }


    .encuesta-subtitulo-preguntas {
        margin-top: 10px;
        padding: 20px;
        padding-top: 18px;
        background-color: #FFFFFF;
        border-radius: 8px;
        border: 0.5px solid #BCBABA;
    }
</style>
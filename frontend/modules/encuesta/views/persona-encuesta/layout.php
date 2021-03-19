<?php

use yii\base\DynamicModel;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use common\models\masters\Departamentos;
use frontend\modules\encuesta\models\EncuestaTipoEncuesta;
use common\helpers\h;

$this->title = Yii::t('app',  "asdasddsa");


?>

<div class="encuesta-encuesta-preguntas">
    <div>
        <div class="encuesta-titulo-franja">

        </div>
        <div class="encuesta-titulo-preguntas">
            
            <div class="encuesta-subtitulo">
               <span class="glyphicon glyphicon-list-alt"></span> <?=  $mensaje ?>
            </div>
        </div>
        


    </div>




</div>

<style>
    .encuesta-encuesta-preguntas {
        background-color: #EBDCE1;
        padding: 20px 40px 20px 40px;
        min-height: 76vh;
    }


    .encuesta-titulo-franja {
        height: 10px;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;

        left: -1px;
        top: -1px;
        width: calc(100%);
        background-color: #910128;
    }

    .encuesta-titulo-preguntas {
        background-color: #FFFFFF;
        border-radius: 0px 0px 8px 8px;
        border: 0.5px solid #BCBABA;
    }


    .encuesta-subtitulo {
        padding: 40px;
        font-family: Roboto, Arial, sans-serif;
        font-size: 30px;
        font-weight: 400;
        letter-spacing: .2px;
        line-height: 20px;
        color: #202124;
        
    }
</style>
<?php
use yii\base\DynamicModel;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use common\models\masters\Departamentos;
use frontend\modules\encuesta\models\EncuestaTipoEncuesta;
use common\helpers\h;
$this->title = Yii::t('app', $encuesta->titulo_encuesta);


?>



<div class="encuesta-encuesta-preguntas">
    <div class="text-center encuesta-titulo-preguntas">
        <h1><?= Html::encode($this->title) ?></h1>
        <p><?= Html::encode("Encuesta realizada por el Dpt de ". h::getNombreDepartamentoById($encuesta->id_dep_encargado)) ?></p>
        <p><?= Html::encode($encuesta->descripcion) ?></p>
        
    </div>
    
    <div class="text-center encuesta-subtitulo-preguntas">
        <h4><?= Html::encode('INSTRUCCIONES') ?></h4>
        <span><?= Html::encode("Lea atentamente las preguntas y responda.") ?></span>
    </div>

    <div>
        <?php 
       
        echo $this->render(h::getTipoEncuesta(EncuestaTipoEncuesta::findOne(['id'=>$encuesta->id_tipo_encuesta])->nombre_tipo),
        ['id_encuesta'=>$encuesta->id, 'listaPreguntas' => $listaPreguntas,  'model'=> $model]); 
        ?>

    </div>



</div>

<style>

    .encuesta-encuesta-preguntas{
        background-color: #E9E9E9;
        padding: 20px 40px 20px 40px;
    }

    .encuesta-titulo-preguntas{
        padding: 5px;
        background-color: #FFFFFF;
        border-radius: 15px;
        border: 0.5px solid #BCBABA;
    }

    .encuesta-subtitulo-preguntas{
        margin-top: 10px;
        padding: 2px;
        background-color: #FFFFFF;
        border-radius: 15px;
        border: 0.5px solid #BCBABA;
    }
    

</style>
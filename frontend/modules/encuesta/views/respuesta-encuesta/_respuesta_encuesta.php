<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use frontend\modules\buzon\models\BuzonMensajeRespuesta;
use frontend\modules\encuesta\models\EncuestaPersonaEncuesta;
use frontend\modules\encuesta\models\EncuestaPreguntaEncuesta;
use frontend\modules\encuesta\models\EncuestaRespuestaEncuesta;

?>
<div class="buzon-historial-index">


    <?php
    
    $queru = EncuestaRespuestaEncuesta::find()->alias('t')->select(['t.respuesta', 'p.pregunta'])->
    // alias('t')->
    innerJoin('encuesta_pregunta_encuesta as p', "p.id=t.id_pregunta")->where(['id_persona_encuesta' => $identidad_unidad]);
    $id_pjax_content = 'dsdsiooioryr';
     ?>
     <?php Pjax::begin(['id' => 'gridTraba2']); ?>
    <?php
    $dataProvider = new ActiveDataProvider(
        /*[
            'query' => (new \yii\db\Query())->select(['t.id as id','p.am', 'p.ap', 'p.nombres', 't.fecha','t.id_persona'])->from('{{%encuesta_persona_encuesta}} t')->
                // alias('t')->
                rightJoin('{{%personas}} p', "p.id=t.id_persona")->where(['id_encuesta' => $identidad_unidad]),
            'pagination' => [
                'pageSize' => 20,
            ]

        ]*/
        //'encuesta_pregunta_encuesta as p', "p.id=t.id_pregunta"
        [
            'query' => (new \yii\db\Query())->select(['t.respuesta','p.pregunta'])->from('{{%encuesta_respuesta_encuesta}} t')->
                // alias('t')->
                rightJoin('{{%encuesta_pregunta_encuesta}} p', "p.id=t.id_pregunta")->where(['t.id_persona_encuesta' => $identidad_unidad]),
            'pagination' => [
                'pageSize' => 150,
            ]
            
        ]
    );
     
   // var_dump($queru->createCommand()->sql);  DIE();
   //var_dump($dataProvider);  DIE();
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['style' => ''],
        //'filterModel' => $searchModel,
        'columns' => [
            'pregunta',
            'respuesta',
            
            
            
        ],
    ]); ?>
<?php
            echo linkAjaxGridWidget::widget(
                [
                    'id' => 'sdsds',
                    'idGrilla' => 'gridTraba2',
                    'family' => 'holas',
                    'type' => 'POST',
                    'evento' => 'click',
                    'posicion' => \yii\web\View::POS_END
                ]


            );
            ?>
    <?php Pjax::end(); ?>

</div>
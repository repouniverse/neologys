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
    //
    $queru = (new \yii\db\Query())->select(['t.respuesta , COUNT(t.respuesta) as contador '])->from('{{%encuesta_respuesta_encuesta}} t')->
    // alias('t')->
    where(['t.id_pregunta' => $identidad_unidad])->groupBy('t.respuesta')->having('COUNT(t.respuesta)');
    $id_pjax_content = 'dsdsiooioryr';
    //var_dump($queru->createCommand()->sql);  DIE();
     ?>
     <?php Pjax::begin(['id' => 'gridTraba2']); ?>
    <?php
    $dataProvider = new ActiveDataProvider(
        
        [
            'query' =>$queru,
            
            'pagination' => [
                'pageSize' => 150,
            ]
            
        ]
    );
   
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['style' => ''],
        //'filterModel' => $searchModel,
        'columns' => [
            'respuesta',
            'contador', 
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
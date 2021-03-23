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
    //echo $identidad_unidad;die();
    $queru = (new \yii\db\Query())->select(['t.pregunta'])->from('{{%encuesta_pregunta_encuesta}} t')->
    // alias('t')->
    rightJoin('{{%encuesta_respuesta_encuesta}} p', "t.id=p.id_pregunta")->where(['t.id_encuesta' => $identidad_unidad]);
    $id_pjax_content = 'dsdsiooioryr';
     ?>
     <?php Pjax::begin(['id' => 'gridTraba2']); ?>
    <?php
    $dataProvider = new ActiveDataProvider(
        
        [
            'query' => EncuestaPreguntaEncuesta::find()->alias('t')->select(['t.pregunta','t.id'])->where(['id_encuesta'=>$identidad_unidad]),
            
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
            [
                'columnKey'=>'buzon_mensaje_id',
                'class' => 'kartik\grid\ExpandRowColumn',
                'width' => '50px',
                
                'value' => function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function ($model, $key, $index, $column) {                    
                    // $dataProvider= \frontend\modules\acad\models\AcadContenidoSyllabusSe 
                    
                    return $this->render('_stat_respuesta_encuesta', [
                        'identidad_unidad' => $model->id,

                    ]);
                
                },
                'expandOneOnly' => true
            ],
            'pregunta',
            
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
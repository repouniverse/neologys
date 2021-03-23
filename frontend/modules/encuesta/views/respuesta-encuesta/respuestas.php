<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use frontend\modules\buzon\models\BuzonMensajeRespuesta;
use frontend\modules\encuesta\models\EncuestaPersonaEncuesta;
use frontend\modules\encuesta\models\EncuestaRespuestaEncuesta;

?>
<div class="buzon-historial-index">


    <?php
    $queru = EncuestaPersonaEncuesta::find()->alias('t')->select(['t.id as id','p.am as am', 'p.ap', 'p.nombres', 't.fecha','t.id_persona'])->
    innerJoin('personas as p', "p.id=t.id_persona")->where(['id_encuesta' => $identidad_unidad]);
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
        [
            'query' =>  EncuestaPersonaEncuesta::find()->alias('t')->select(['t.id as id','p.am as am', 'p.ap', 'p.nombres', 't.fecha','t.id_persona'])->
                // alias('t')->
                innerJoin('personas as p', "p.id=t.id_persona")->where(['id_encuesta' => $identidad_unidad]),
                'pagination' => [
                    'pageSize' => 150,
                ]
            
        ]
    );
     
    //var_dump($queru->createCommand()->sql);  DIE();
    //var_dump($dataProvider);  DIE();
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
                    return $this->render('_respuesta_encuesta', [
                        'identidad_unidad' => $model->id,

                    ]);
                
                },
                'expandOneOnly' => true
            ],
            'persona.nombres',
            'persona.ap',
            'persona.am',
            //'id_persona',
            'fecha',
            
            
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
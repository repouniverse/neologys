<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
use kartik\grid\GridView;
use common\models\masters\Departamentos;
use frontend\modules\encuesta\models\EncuestaTipoEncuesta;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\encuesta\models\EncuestaRespuestaEncuestaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Respuestas de las Encuestas');

?>
<div class="encuesta-respuesta-encuesta-index">

    <div>
        <div class="encuesta-titulo-franja">

        </div>
        <div class="text-center encuesta-titulo-index">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>

    </div>
    <div class="encuesta_grilla">
        <?php Pjax::begin(['id' => 'gridTraba']); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); 
        ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'options' => ['style' => ''],
            //'tableOptions' => ['class' => 'table table-condensed table-hover table-bordered table-striped','style' => 'widht : 25%'],
            'columns' => [
                [
                    'columnKey' => 'buzon_mensaje_id',
                    'class' => 'kartik\grid\ExpandRowColumn',
                    'width' => '50px',

                    'value' => function ($model, $key, $index, $column) {
                        return GridView::ROW_COLLAPSED;
                    },
                    'detail' => function ($model, $key, $index, $column) {
                        // $dataProvider= \frontend\modules\acad\models\AcadContenidoSyllabusSe  
                        return $this->render('_tap_stat', [
                            'identidad_unidad' => $model->id,

                        ]);
                    },
                    'expandOneOnly' => true,
                    'expandIcon' => '<span class="glyphicon glyphicon-triangle-right"></span>',
                    'collapseIcon' => '<span class="glyphicon glyphicon-triangle-bottom"></span>',
                ],
                'titulo_encuesta',
                [

                    'attribute' => 'id_tipo_encuesta',
                    'label' => 'Tipo de encuesta',
                    'value' => function ($model, $key, $index, $column) {
                        return EncuestaTipoEncuesta::findOne(['id' => $model->id_tipo_encuesta])->nombre_tipo;
                    },

                ], /*
                [
                    'attribute' => 'descripcion',
                    'label' => 'Descripción',

                    'value' => function ($model, $key, $index, $column) {
                        return $model->descripcion;
                    },
                ],*/

                [
                    'attribute' => 'id_dep_encargado',
                    'label' => 'Departamento encargado',
                    'value' => function ($model, $key, $index, $column) {
                        return Departamentos::findOne(['id' => $model->id_dep_encargado])->nombredepa;
                    },
                ],

                'numero_preguntas',


            ],
        ]); ?>
        <?php
        echo linkAjaxGridWidget::widget(
            [
                'id' => 'sdsds',
                'idGrilla' => 'gridTraba',
                'family' => 'holas',
                'type' => 'POST',
                'evento' => 'click',
                'posicion' => \yii\web\View::POS_END
            ]


        );
        ?>
        <?php Pjax::end(); ?>
    </div>
</div>

<style>
    a {
        color: #910128;
    }

    a:hover,
    a:active,
    a:focus {
        outline: none;
        text-decoration: none;
        color: #910128;
    }

    .encuesta-respuesta-encuesta-index{
        background-color: #EBDCE1;
        min-height: 76vh;
        padding: 20px;
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

    .encuesta-titulo-index {
        padding: 5px;
        background-color: #FFFFFF;
        border-radius: 0px 0px 8px 8px;
        border: 0.5px solid #BCBABA;
    }

    .encuesta_grilla {
        background-color: white;
        border-radius: 8px;
        border: 0.5px solid #BCBABA;
        padding: 20px;
        margin-top: 10px;
    }
</style>
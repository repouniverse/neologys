<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use common\models\masters\Departamentos;
use frontend\modules\encuesta\models\EncuestaTipoEncuesta;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\encuesta\models\EncuestaPersonaEncuestaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Encuestas Disponibles');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="encuesta-index ">
    <div>
        <div class="encuesta-titulo-franja">

        </div>
        <div class="text-center encuesta-titulo-index">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>

    </div>




    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>
    <div class="encuesta_grilla">

   

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['style' => 'widht : 25%'],
        //'tableOptions' => ['class' => 'table table-condensed table-hover table-bordered table-striped','style' => 'widht : 25%'],
        'columns' => [

            'titulo_encuesta',
            [
                'attribute' => 'id_tipo_encuesta',
                'label' => 'Tipo de encuesta',
                'value' => function ($model, $key, $index, $column) {
                    return EncuestaTipoEncuesta::findOne(['id' => $model->id_tipo_encuesta])->nombre_tipo;
                },
            ],
            [
                'attribute' => 'descripcion',
                'label' => 'Descripción',
                'contentOptions' =>  ['style' => 'widht : 25%'],
                'value' => function ($model, $key, $index, $column) {
                    return $model->descripcion;
                },
            ],

            [
                'attribute' => 'id_dep_encargado',
                'label' => 'Departamento encargado',
                'value' => function ($model, $key, $index, $column) {
                    return Departamentos::findOne(['id' => $model->id_dep_encargado])->nombredepa;
                },
            ],

            'numero_preguntas',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{realizar}',
                'buttons' => [
                    'realizar' => function ($url, $model) {
                        $url = Url::to(['encuesta', 'id' => $model->id]);
                        $options = [
                            'title' => yii::t('base_verbs', 'Realizar'), 'data-pjax' => '0'
                        ];
                        return Html::a('<span class="btn btn-success btn-md glyphicon glyphicon-log-in"></span>', $url, $options/*$options*/);
                    },

                ]
            ],
        ],
    ]); ?>
     </div>


</div>

<style>
    .encuesta-index {
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

    .encuesta_grilla{
        background-color: white;
        border-radius: 8px;
        border: 0.5px solid #BCBABA;
        padding: 20px;
        margin-top: 10px;
    }
</style>
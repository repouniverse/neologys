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

    <div class="text-center encuesta-titulo-index">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <br><br>



    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'titulo_encuesta',
            [
                'attribute' => 'id_tipo_encuesta',
                'label' => 'Tipo de encuesta',
                'value' => function ($model, $key, $index, $column) {
                    return EncuestaTipoEncuesta::findOne(['id' => $model->id_tipo_encuesta])->nombre_tipo;
                },
            ],
            'descripcion',

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

<style>

    .encuesta-index{
        background-color: #E9E9E9;
        padding: 20px;
    }
    .encuesta-titulo-index{
        padding: 5px;
        margin: 0px 50px 0px 50px;
        background-color: #FFFFFF;
        border-radius: 15px;
    }

</style>
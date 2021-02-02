<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\data\ActiveDataProvider;
use frontend\modules\buzon\models\BuzonMensajeRespuesta;

?>
<div class="buzon-historial-index">


    <?php
    $id_pjax_content = 'dsdsiooioryr';
    Pjax::begin(['id' => $id_pjax_content, 'timeout' => false]); ?>
    <?php
    $dataProvider = new ActiveDataProvider([
        'query' => BuzonMensajeRespuesta::find()->select([
            'fecha_respuesta',
            'mensaje_respuesta',
            'hora_respuesta',
        ])->andWhere(['bm_id' => $identidad_unidad]),
        'pagination' => [
            'pageSize' => 300,
        ]
    ]);
    // var_dump($dataProvider->getModels()[0]->id);  DIE();
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        //'filterModel' => $searchModel,
        'columns' => [

            'fecha_respuesta',
            'mensaje_respuesta',
            'hora_respuesta'
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
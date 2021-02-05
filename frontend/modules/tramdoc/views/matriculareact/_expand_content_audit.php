<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\data\ActiveDataProvider;
use common\helpers\h;
use frontend\modules\tramdoc\models\TramdocAuditoria;

?>
<div class="buzon-historial-index">


    <?php
    $id_pjax_content = 'dsdsiooioryr';
    Pjax::begin(['id' => $id_pjax_content, 'timeout' => false]); ?>
    <?php
    $dataProvider = new ActiveDataProvider(
        [
            'query' => (new \yii\db\Query())->select(['p.am', 'p.ap', 'p.nombres', 't.campo_modificado', 't.valor_modificado', 't.fecha_modif'])->from('{{%tramdoc_auditoria}} t')->
                // alias('t')->
                rightJoin('{{%personas}} p', "p.id=t.persona_id")->where(['matr_id' => $identidad_unidad]),
            'pagination' => [
                'pageSize' => 20,
            ]

        ]
    );
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        //'filterModel' => $searchModel,
        'columns' => [
            // 'ap',
            ['attribute'=>'ap',
            'label'=>'Ap. Paterno'],
            ['attribute'=>'am',
            'label'=>'Ap. Materno'],
            //'am',
            'nombres',
            'campo_modificado',
            'valor_modificado',            
            [
                'attribute' => 'fecha_modif',
                'format' =>['date', 'php: d-m-Y'],
                'label'=>'Fecha de Modificación',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
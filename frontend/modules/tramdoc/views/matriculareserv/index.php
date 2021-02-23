<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\tramdoc\models\TramdocMatriculaReservSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tramdoc Matricula Reservs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tramdoc-matricula-reserv-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Tramdoc Matricula Reserv'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nro_matr',
            'codigo',
            'carrera_id',
            'dni',
            //'apellido_paterno',
            //'apellido_materno',
            //'nombres',
            //'email_usmp:email',
            //'email_personal:email',
            //'celular',
            //'telefono',
            //'mensaje:ntext',
            //'obs_alumno:ntext',
            //'fecha_solicitud',
            //'fecha_registro',
            //'cta_sin_deuda_pendiente_check',
            //'cta_sin_deuda_pendiente_obs:ntext',
            //'cta_pago_tramite_check',
            //'cta_pago_tramite_adjunto',
            //'cta_pago_tramite_obs:ntext',
            //'ora_soli_reg_check',
            //'ora_soli_reg_adjunto',
            //'ora_soli_reg_obs:ntext',
            //'estado',
            //'estado_obs:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\helpers\h;

/* @var $this yii\web\View */
/* @var $model frontend\modules\tramdoc\models\Matriculareact */

$this->title = Yii::t('base_labels', 'Datos Registrados');
$this->params['breadcrumbs'][] = ['label' => Yii::t('base_labels', 'Matriculareacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="matriculareact-view">

    <h4><?=h::awe('eye').h::space(10).Html::encode($this->title) ?></h4>
    <div class="box box-body">
    <br>

    <p>
        <?= Html::a(Yii::t('base_labels', 'Actualizar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

        <?= Html::a(Yii::t('base_labels', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('base_labels', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>

    </p>
        <style>
            table.detail-view th {
                width: 25%;
            }
            table.detail-view td {
                width: 75%;
            }
        </style>

    <h4>Datos de la solicitud:</h4>
    <hr>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nro_matr',
            'codigo',
            'carrera_id',
            'dni',
            'apellido_paterno',
            'apellido_materno',
            'nombres',
            'email_usmp:email',
            'email_personal:email',
            'celular',
            'telefono',
            'mensaje:ntext',
            'fecha_solicitud',
            'fecha_registro',
        ],
    ]) ?>


        <br>
        <h4>1. Seguimiento de Cuentas Corrientes:</h4>
        <hr>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'cta_sin_deuda_pendiente_check',
                'cta_sin_deuda_pendiente_obs:ntext',
                'cta_pago_tramite_check',
                'cta_pago_tramite_adjunto',
                'cta_pago_tramite_obs:ntext',

            ],
        ]) ?>
        <br>
        <h4>2. Seguimiento de Registros Académicos:</h4>
        <hr>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'ora_record_notas_check',
                'ora_record_notas_adjunto',
                'ora_record_notas_obs:ntext',
            ],
        ]) ?>
        <br>
        <h4>3. Seguimiento de Departamento Académico:</h4>
        <hr>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'aca_cursos_aptos_check',
                'aca_cursos_aptos_adjunto',
                'aca_cursos_aptos_observaciones:ntext',
                'ora_cursos_aptos_check',
                'ora_cursos_aptos_obs:ntext',
            ],
        ]) ?>
        <br>
        <h4>4. Seguimiento de Registros Académicos:</h4>
        <hr>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'ora_cursos_aptos_check',
                'ora_cursos_aptos_obs:ntext',
            ],
        ]) ?>
        <br>
        <h4>5. Seguimiento de OTI:</h4>
        <hr>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'oti_cursos_aptos_check',
                'oti_cursos_aptos_obs:ntext',
                'oti_notifica_email_check:email',
                'oti_notifica_email_obs:ntext',
            ],
        ]) ?>

</div>

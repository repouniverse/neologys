<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\tramdoc\models\TramdocMatriculaReserv */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tramdoc Matricula Reservs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tramdoc-matricula-reserv-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

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
            'obs_alumno:ntext',
            'fecha_solicitud',
            'fecha_registro',
            'cta_sin_deuda_pendiente_check',
            'cta_sin_deuda_pendiente_obs:ntext',
            'cta_pago_tramite_check',
            'cta_pago_tramite_adjunto',
            'cta_pago_tramite_obs:ntext',
            'ora_soli_reg_check',
            'ora_soli_reg_adjunto',
            'ora_soli_reg_obs:ntext',
            'estado',
            'estado_obs:ntext',
        ],
    ]) ?>

</div>

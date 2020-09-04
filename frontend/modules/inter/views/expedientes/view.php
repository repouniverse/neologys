<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\inter\models\InterExpedientes */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('labels', 'Inter Expedientes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="inter-expedientes-view">

    <h4><?= Html::encode($this->title) ?></h4>

    <p>
        <?= Html::a(Yii::t('labels', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('labels', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('labels', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'universidad_id',
            'facultad_id',
            'depa_id',
            'programa_id',
            'modo_id',
            'convocado_id',
            'clase',
            'status',
            'codocu',
            'fpresenta',
            'fdocu',
            'detalles:ntext',
            'textointerno:ntext',
            'estado',
            'requerido',
            'plan_id',
            'orden',
            'etapa_id',
            'secuencia',
            'current_etapa',
        ],
    ]) ?>

</div>

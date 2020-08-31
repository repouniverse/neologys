<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\modules\inter\Module as m;
/* @var $this yii\web\View */
/* @var $model frontend\modules\inter\models\InterExpedientes */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Inter Files'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="inter-expedientes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(m::t('verbs', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(m::t('verbs', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => m::t('validaciones', 'Are you sure you want to delete this item?'),
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
        ],
    ]) ?>

</div>

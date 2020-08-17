<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\inter\models\InterConvocados */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('base_labels', 'Inter Convocados'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="inter-convocados-view">

    <h4><?= Html::encode($this->title) ?></h4>

    <p>
        <?= Html::a(Yii::t('base_labels', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('base_labels', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('base_labels', 'Are you sure you want to delete this item?'),
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
            'modo_id',
            'codperiodo',
            'codocu',
            'programa_id',
            'clase',
            'status',
            'secuencia',
            'alumno_id',
            'docente_id',
            'persona_id',
            'identidad_id',
            'codalu',
            'codigo1',
            'codigo2',
        ],
    ]) ?>

</div>

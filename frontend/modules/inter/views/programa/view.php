<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\modules\inter\Module as m;
/* @var $this yii\web\View */
/* @var $model frontend\modules\inter\models\InterPrograma */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Inter Programs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="inter-programa-view">

    <h4><?= Html::encode($this->title) ?></h4>

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
            'codperiodo',
            'depa_id',
            'clase',
            'programa_id',
            'fopen',
            'descripcion',
            'detalles:ntext',
        ],
    ]) ?>

</div>

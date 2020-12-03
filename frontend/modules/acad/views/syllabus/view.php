<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\acad\models\AcadSyllabus */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('base_labels', 'Acad Syllabi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="acad-syllabus-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'plan_id',
            'codperiodo',
            'curso_id',
            'n_horasindep',
            'docente_owner_id',
            'datos_generales:ntext',
            'sumilla:ntext',
            'competencias:ntext',
            'prog_contenidos:ntext',
            'estrat_metod:ntext',
            'recursos_didac:ntext',
            'formula_id',
            'fuentes_info:ntext',
            'reserva1:ntext',
            'reserva2:ntext',
        ],
    ]) ?>

</div>

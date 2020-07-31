<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Alumnos */

$this->title = Yii::t('base.labels', 'Update university: {name}', [
    'name' => $model->nombre,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('base.labels', 'Universities'), 'url' => ['index-univer']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view-univer', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('base.labels', 'Update');
?>
<div class="alumnos-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form_univer', [
        'model' => $model,
    ]) ?>


</div>
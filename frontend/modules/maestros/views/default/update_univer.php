<?php

use yii\helpers\Html;
use frontend\modules\maestros\MaestrosModule as m;
/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Alumnos */

$this->title = m::t('labels', 'Update University: {name}', [
    'name' => $model->nombre,
]);
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Universities'), 'url' => ['index-univer']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view-univer', 'id' => $model->id]];
$this->params['breadcrumbs'][] = m::t('verbs', 'Update');
?>
<div class="alumnos-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form_univer', [
        'model' => $model,
    ]) ?>


</div>
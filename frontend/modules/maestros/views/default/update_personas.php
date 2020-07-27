<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Trabajadores */

$this->title = Yii::t('base.actions', 'Update Person: {name}', [
    'name' => $model->codigotra,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('base.labels', 'Persons'), 'url' => ['index-personas']];
$this->params['breadcrumbs'][] = ['label' => $model->codigotra, 'url' => ['view-persona', 'id' => $model->codigoper]];
$this->params['breadcrumbs'][] = Yii::t('control.errors', 'Update');
?>
<div class="trabajadores-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form_persona', [
        'model' => $model,
    ]) ?>

</div>

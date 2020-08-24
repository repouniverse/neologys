<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\inter\models\InterExpedientes */

$this->title = Yii::t('base_labels', 'Update Inter Expedientes: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('base_labels', 'Inter Expedientes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('base_labels', 'Update');
?>
<div class="inter-expedientes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

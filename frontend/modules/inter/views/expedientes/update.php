<?php

use yii\helpers\Html;
use frontend\modules\inter\Module as m;
/* @var $this yii\web\View */
/* @var $model frontend\modules\inter\models\InterExpedientes */

$this->title = m::t('labels', 'Update Inter Files: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Inter Files'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = m::t('verbs', 'Update');
?>
<div class="inter-expedientes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

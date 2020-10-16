<?php

use yii\helpers\Html;
use frontend\modules\inter\Module as m;

/* @var $this yii\web\View */
/* @var $model frontend\modules\inter\models\InterExpedientes */

$this->title = m::t('labels', 'Create Inter Files');
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Inter Files'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inter-expedientes-create">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
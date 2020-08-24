<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\inter\models\InterExpedientes */

$this->title = Yii::t('base_labels', 'Create Inter Expedientes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('base_labels', 'Inter Expedientes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inter-expedientes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

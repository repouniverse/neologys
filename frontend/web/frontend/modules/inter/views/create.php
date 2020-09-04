<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\inter\models\InterExpedientes */

$this->title = Yii::t('labels', 'Create Inter Expedientes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('labels', 'Inter Expedientes'), 'url' => ['index']];
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
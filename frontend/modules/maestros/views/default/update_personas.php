<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Trabajadores */

$this->title = Yii::t('base.labels', 'Update Person: {name}', [
    'name' => $model->codigoper,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('base.labels', 'Persons'), 'url' => ['index-personas']];
$this->params['breadcrumbs'][] = ['label' => $model->codigoper, 'url' => ['view-persona', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('base.errors', 'Update');
?>
<div class="trabajadores-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form_personas', [
        'model' => $model,
    ]) ?>

</div>

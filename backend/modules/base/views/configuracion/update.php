<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\masters\GrupoParametros */

$this->title = Yii::t('base.labels', 'Update Grupo Parametros: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('base.labels', 'Grupo Parametros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('base.labels', 'Update');
?>
<div class="grupo-parametros-update">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>

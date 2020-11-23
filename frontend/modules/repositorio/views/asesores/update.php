<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Asesores */

$this->title = Yii::t('app', 'Update Asesores: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Asesores'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="asesores-update">
 <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
	
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

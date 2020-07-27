<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Periodos */

$this->title = Yii::t('base.labels', 'Update Periodos: {name}', [
    'name' => $model->codperiodo,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('base.labels', 'Periodos'), 'url' => ['index-periodo']];
$this->params['breadcrumbs'][] = ['label' => $model->codperiodo, 'url' => ['view-periodo', 'id' => $model->codperiodo]];
$this->params['breadcrumbs'][] = Yii::t('base.labels', 'Update');
?>
<h4><?= Html::encode($this->title) ?></h4>
<div class="periodos-update">
<div class="box box-success">
    

    <?= $this->render('_form_periodo', [
        'model' => $model,
    ]) ?>

</div>
</div>
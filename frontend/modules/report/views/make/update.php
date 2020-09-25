<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\report\models\Reporte */

$this->title = Yii::t('report.messages', 'Editar Reporte: {name}', [
    'name' => $model->nombrereporte,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('report.messages', 'Reportes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('report.messages', 'Editar');
?>
<div class="reporte-update">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
    <div class="box-body">
    <?= $this->render('_form', [
        'model' => $model,
            'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
    ]) ?>

</div>
    </div>
    </div>
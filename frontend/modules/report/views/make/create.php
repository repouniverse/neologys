<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\report\models\Reporte */
//echo "hol"; die();
$this->title = Yii::t('report.messages', 'Create Reporte');
$this->params['breadcrumbs'][] = ['label' => Yii::t('report.messages', 'Reportes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reporte-create">
<div class="box box-success">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div></div>

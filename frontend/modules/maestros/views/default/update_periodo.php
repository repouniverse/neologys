<?php

use yii\helpers\Html;
use frontend\modules\maestros\MaestrosModule as m;
/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Periodos */

$this->title = m::t('labels', 'Update Period: {name}', [
    'name' => $model->codperiodo,
]);
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Periods'), 'url' => ['index-periodo']];
$this->params['breadcrumbs'][] = ['label' => $model->codperiodo, 'url' => ['view-periodo', 'id' => $model->codperiodo]];
$this->params['breadcrumbs'][] = m::t('verbs', 'Update');
?>
<h4><?= Html::encode($this->title) ?></h4>
<div class="periodos-update">
<div class="box box-success">
    

    <?= $this->render('_form_periodo', [
        'model' => $model,
    ]) ?>

</div>
</div>
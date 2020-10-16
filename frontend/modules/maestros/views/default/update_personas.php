<?php

use yii\helpers\Html;
use frontend\modules\maestros\MaestrosModule as m;
/* @var $this yii\web\View */
/* @var $model common\models\masters\Trabajadores */

$this->title = m::t('labels', 'Update Person: {name}', [
    'name' => $model->codigoper,
]);
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Persons'), 'url' => ['index-personas']];
$this->params['breadcrumbs'][] = ['label' => $model->codigoper, 'url' => ['view-persona', 'id' => $model->id]];
$this->params['breadcrumbs'][] = m::t('verbs', 'Update');
?>
<div class="trabajadores-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form_personas', [
        'model' => $model,
    ]) ?>

</div>

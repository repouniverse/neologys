<?php
use common\widgets\spinnerWidget\spinnerWidget;
use yii\helpers\Html;
use frontend\modules\import\ModuleImport as m;
/* @var $this yii\web\View */
/* @var $model frontend\modules\import\models\ImportCargamasiva */

$this->title = m::t('labels', 'Editar importación : {name}', [
    'name' => $model->descripcion,
]);
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Importaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = m::t('labels', 'Editar');
?>
<div class="import-cargamasiva-update">
 <?php ECHO spinnerWidget::widget();?>
    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,'itemsFields'=> $itemsFields,
            'itemsLoads'=> $itemsLoads,
    ]) ?>


</div>
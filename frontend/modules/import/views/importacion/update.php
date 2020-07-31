<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\import\models\ImportCargamasiva */

$this->title = Yii::t('import.labels', 'Editar importación : {name}', [
    'name' => $model->descripcion,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('import.labels', 'Importaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('import.labels', 'Editar');
?>
<div class="import-cargamasiva-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,'itemsFields'=> $itemsFields,
            'itemsLoads'=> $itemsLoads,
    ]) ?>


</div>
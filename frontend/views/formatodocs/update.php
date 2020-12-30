<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FormatoDocs */

$this->title = Yii::t('base_labels', 'Update Formato Docs: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('base_labels', 'Formato Docs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('base_labels', 'Update');
?>
<div class="formato-docs-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

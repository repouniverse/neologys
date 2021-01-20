<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\buzon\models\BuzonMensajes */

$this->title = Yii::t('app', 'Update Buzon Mensajes: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Buzon Mensajes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="buzon-mensajes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

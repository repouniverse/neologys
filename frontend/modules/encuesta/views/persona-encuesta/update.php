<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\encuesta\models\EncuestaPersonaEncuesta */

$this->title = Yii::t('app', 'Update Encuesta Persona Encuesta: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Encuesta Persona Encuestas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="encuesta-persona-encuesta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

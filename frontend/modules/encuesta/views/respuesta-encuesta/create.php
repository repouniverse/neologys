<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\encuesta\models\EncuestaRespuestaEncuesta */

$this->title = Yii::t('app', 'Create Encuesta Respuesta Encuesta');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Encuesta Respuesta Encuestas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="encuesta-respuesta-encuesta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

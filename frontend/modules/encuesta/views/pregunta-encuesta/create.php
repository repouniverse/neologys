<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\encuesta\models\EncuestaPreguntaEncuesta */

$this->title = Yii::t('app', 'Create Encuesta Pregunta Encuesta');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Encuesta Pregunta Encuestas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="encuesta-pregunta-encuesta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

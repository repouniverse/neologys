<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\encuesta\models\EncuestaOpcionesPregunta */

$this->title = Yii::t('app', 'Create Encuesta Opciones Pregunta');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Encuesta Opciones Preguntas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="encuesta-opciones-pregunta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

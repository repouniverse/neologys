<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\encuesta\models\EncuestaPersonaEncuesta */

$this->title = Yii::t('app', 'Create Encuesta Persona Encuesta');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Encuesta Persona Encuestas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="encuesta-persona-encuesta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

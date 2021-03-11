<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\encuesta\models\EncuestaTipoPregunta */

$this->title = Yii::t('app', 'Create Encuesta Tipo Pregunta');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Encuesta Tipo Preguntas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="encuesta-tipo-pregunta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

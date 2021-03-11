<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\encuesta\models\EncuestaTipoEncuesta */

$this->title = Yii::t('app', 'Create Encuesta Tipo Encuesta');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Encuesta Tipo Encuestas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="encuesta-tipo-encuesta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

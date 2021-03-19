<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\encuesta\models\EncuestaEncuestaGeneral */

$this->title = Yii::t('app', 'CREAR ENCUESTA - PASO 1');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Encuesta Encuesta Generals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="encuesta-encuesta-general-create">

    <h4><?= Html::encode($this->title) ?></h4>
    <div class="box box-success"></div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

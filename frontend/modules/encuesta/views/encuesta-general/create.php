<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\encuesta\models\EncuestaEncuestaGeneral */

$this->title = Yii::t('app', 'Create Encuesta Encuesta General');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Encuesta Encuesta Generals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="encuesta-encuesta-general-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

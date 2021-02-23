<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\tramdoc\models\TramdocMatriculaReserv */

$this->title = Yii::t('app', 'Create Tramdoc Matricula Reserv');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tramdoc Matricula Reservs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tramdoc-matricula-reserv-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

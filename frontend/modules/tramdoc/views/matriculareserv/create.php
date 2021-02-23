<?php

use yii\helpers\Html;
use common\helpers\h;
/* @var $this yii\web\View */
/* @var $model frontend\modules\tramdoc\models\TramdocMatriculaReserv */

$this->title = Yii::t('app', 'CREAR RESERVA DE MATRÍCULA');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tramdoc Matricula Reservs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tramdoc-matricula-reserv-create">

<h4><?=h::awe('envelope-open-o').h::space(10).Html::encode($this->title) ?></h4>
<div class="box box-success">
<br>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

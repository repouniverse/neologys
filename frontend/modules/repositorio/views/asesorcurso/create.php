<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\masters\AsesoresCurso */

$this->title = Yii::t('app', 'Create Asesores Curso');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Asesores Cursos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asesores-curso-create">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-body">

    <?= $this->render('_form', [
        'model' => $model, 'modelalumno'=> $modelalumno
    ]) ?>
</div>
</div>

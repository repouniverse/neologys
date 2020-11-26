<?php

use yii\helpers\Html;
use common\helpers\h;
/* @var $this yii\web\View */
/* @var $model common\models\masters\AsesoresCurso */
$titulo=($tienecursos)?Yii::t('base_verbs', 'Select your adviser'):
   Yii::t('base_verbs', 'View your adviser');
$this->title =$titulo ;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Asesores Cursos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asesores-curso-create">

    <h4><?=h::awe('user')?><?=$modelalumno->nombres.'  '. Html::encode($this->title) ?></h4>
<div class="box box-body">

    <?= $this->render('_form', [
        'model' => $model, 'modelalumno'=> $modelalumno, 'tienecursos'=>$tienecursos
    ]) ?>
</div>
</div>

<?php

use yii\helpers\Html;
use common\helpers\h;
/* @var $this yii\web\View */
/* @var $model common\models\masters\AsesoresCurso */
$titulo=Yii::t('base_labels', 'Manage your files');
$this->title =$titulo ;
$this->params['breadcrumbs'][] = ['label' => Yii::t('base_labels', 'Upload files'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asesores-curso-create">

    <h4><?=h::awe('user')?><?=$modelalumno->nombres.'  '. Html::encode($this->title) ?></h4>
<div class="box box-body">

    <?= $this->render('_form_cursos', [
         'modelalumno'=> $modelalumno, 'model'=>$model
    ]) ?>
</div>
</div>


<?php

use common\helpers\h;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\encuesta\models\EncuestaOpcionesPregunta */

$this->title = Yii::t('app', 'Creación De Opciones Por Pregunta');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Encuesta Opciones Preguntas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="encuesta-opciones-pregunta-create">
<h4><?=h::awe('fa fa-align-left').h::space(10).Html::encode($this->title) ?></h4>
<div class="box box-success"></div>

    <?= $this->render('_form', [
        'model' => $model,
        'model_preguntas' => $model_preguntas,
        'numero_preguntas'=> $numero_preguntas,
        'titulo_encuesta' => $titulo_encuesta,
    ]) ?>

</div>

<?php

use common\helpers\h;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\encuesta\models\EncuestaOpcionesPregunta */

$this->title = Yii::t('app', 'Crear Las Opciones De Las Preguntas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Encuesta Opciones Preguntas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="encuesta-opciones-pregunta-create">
<h4><?=h::awe('envelope-open-o').h::space(10).Html::encode($this->title) ?></h4>
<div class="box box-success"></div>

    <?= $this->render('_form', [
        'model' => $model,
        'model_preguntas' => $model_preguntas,
        'numero_preguntas'=> $numero_preguntas,
        
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\encuesta\models\EncuestaPreguntaEncuesta */

$this->title = Yii::t('app', 'Crear Preguntas Para '.'"'.$titulo_encuesta.'"');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Encuesta Pregunta Encuestas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="encuesta-pregunta-encuesta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'numero_preguntas'=>$numero_preguntas,
        'titulo_encuesta'=> $titulo_encuesta,
        'id_tipo_encuesta'=> $id_tipo_encuesta
    ]) ?>

</div>

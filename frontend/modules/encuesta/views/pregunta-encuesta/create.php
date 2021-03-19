<?php
use common\helpers\h;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\encuesta\models\EncuestaPreguntaEncuesta */

$this->title = Yii::t('app', 'Creación De Preguntas Para '.'"'.$titulo_encuesta.'"');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Encuesta Pregunta Encuestas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="encuesta-pregunta-encuesta-create">
<h4><?=h::awe('fa fa-align-left').h::space(10).Html::encode($this->title) ?></h4>
<div class="box box-success"></div>

    <?= $this->render('_form', [
        'model' => $model,
        'numero_preguntas'=>$numero_preguntas,
        'titulo_encuesta'=> $titulo_encuesta,
        'id_tipo_encuesta'=> $id_tipo_encuesta
    ]) ?>

</div>
